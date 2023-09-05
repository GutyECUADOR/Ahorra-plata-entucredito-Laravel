

class FilaPrestamo {
constructor({mes, cuota, ainteres, acapital, capital}) {
    this.mes = mes;
    this.cuota = cuota;
    this.ainteres = ainteres;
    this.acapital = acapital;
    this.capital = capital;
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

            const cantidad = this.credito.cantidad; // Valor iniciar del credito
            const interes = this.credito.interes / 100;
            const cuotas = this.credito.cuotas;

            console.table(cantidad, interes, cuotas);

            const cuota_prestamo = Math.ceil((cantidad * (interes*(1+interes) ** cuotas)) / (((1 + interes) ** cuotas) - 1));

            /* Fila de inicio */
            let filaInicio = new FilaPrestamo({
                mes: 0,
                cuota: 0,
                ainteres: 0,
                acapital: 0,
                capital: cantidad
            });

            this.tablaAmortizacion.push(filaInicio);

            let contador = 1;
            let capital_residual = cantidad;
            while (this.credito.cuotas >= contador) {


                let filaPrestamo = new FilaPrestamo({
                    mes: contador,
                    cuota: cuota_prestamo,
                    ainteres: interes * capital_residual,
                    acapital: this.cuota - this.ainteres,
                    capital: capital_residual - this.acapital
                });

                console.log(filaPrestamo);

                capital_residual = filaPrestamo.capital;


                this.tablaAmortizacion.push(filaPrestamo);
                contador++;
            }


            console.log(this.tablaAmortizacion);


        },

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



