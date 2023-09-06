

class FilaPrestamo {
constructor({mes=0, cuota=0, ainteres=0, acapital=0, capital=0, aextracapital=0, interes=0, capital_residual=0}) {
    this.mes = mes;
    this.cuota = cuota;
    this.ainteres = ainteres;
    this.acapital = acapital;
    this.capital = capital;
    this.aextracapital = aextracapital;
    this.interes = interes;
    this.capital_residual = capital_residual;


    }

    getAinteres(){
        this.ainteres = this.interes * this.capital_residual;
        return this.ainteres;
    }

    getAcapital(){
        this.acapital = this.cuota - this.ainteres;
        return this.acapital;
    }

    getCapital(){
        this.getAinteres()
        this.getAcapital()
        this.capital = this.capital_residual - this.acapital
        return this.capital;
    }



}

const app = new Vue({
    el: '#app',
    data: {
    cod_credito: null,
    credito: null,
    tablaAmortizacion: [],
    search_solicitudes: {
        isloading: false,
        results: []
    },
    solicitudesAprobacion: []
    },
    methods:{
        async getTablaAnalisis() {
            const response = await fetch(`http://ahorraplataentucredito.test/api/analisis/${this.cod_credito}`)
            .then(response => {
                return response.json();
            }).catch( error => {
                console.error(error);
            });
            console.log(response)
            this.credito = response.credito;
            this.generarTabla();

        },
        generarTabla(){
            const cantidad = this.credito.cantidad; // Valor iniciar del credito
            const interes = this.credito.interes / 100;
            const cuotas = this.credito.cuotas;

            console.table(cantidad, interes, cuotas);

            const cuota_prestamo = ((cantidad * (interes*(1+interes) ** cuotas)) / (((1 + interes) ** cuotas) - 1));

            console.log(cuota_prestamo);

            /* Fila de inicio */
            let filaInicio = new FilaPrestamo({
                capital: cantidad
            });

            this.tablaAmortizacion.push(filaInicio);

            let contador = 1;
            let capital_residual = filaInicio.capital;

            while (this.credito.cuotas >= contador) {
                /* let ainteres = interes * capital_residual;

                let acapital = cuota_prestamo - ainteres;
                let capital = capital_residual - acapital */

                let filaPrestamo = new FilaPrestamo({
                    mes: contador,
                    cuota: cuota_prestamo,
                    capital_residual,
                    interes
                });


                capital_residual = filaPrestamo.getCapital();


                this.tablaAmortizacion.push(filaPrestamo);
                contador++;
            }


            console.log(this.tablaAmortizacion);
        }

    },
    filters: {
    checkStatus: function (value) {
        let status = 'No definido';
        switch (value) {
        case '0':
        status = 'Pendiente aprobación'
        break;

        case '1':
        status = 'Aprobado'
        break;

        case '2':
        status = 'Anulado'
        break;

        default:
        break;
        }
        return status;
    }
    },
    mounted(){
    this.cod_credito = document.querySelector('#hiddenCreditoID').value;
    this.getTablaAnalisis();

    }
})



