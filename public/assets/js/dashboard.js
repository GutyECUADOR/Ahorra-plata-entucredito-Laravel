

class FilaPrestamo {
constructor({mes=0, cuota=0, cuotas=0, ainteres=0, acapital=0, capital=0, cantidad=0, aextracapital=0, interes=0, capital_residual=0}) {
    this.mes = mes;
    this.cuota = cuota;
    this.cuotas = cuotas;
    this.ainteres = ainteres;
    this.acapital = acapital;
    this.capital = capital;
    this.cantidad = cantidad;
    this.aextracapital = aextracapital;
    this.interes = interes;
    this.capital_residual = capital_residual;

    }


    getterCapital(){
        const comas = this.capital.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return comas;
    }

    setCapital(event){
        const num = event.target.value;
        const regex = /^[0-9.,\b]+$/;
        if (!regex.test(num)) {
            event.target.value = event.target.value.slice(0, -1);
            return 0;
        }

        const withOutCommas = num.replace(/,/g, '')
        return this.capital = parseInt(withOutCommas);
    }


    getExtraCapital(){
        const comas = this.aextracapital.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return comas;
    }

    setExtraCapital(event){
        const num = event.target.value;
        const regex = /^[0-9.,\b]+$/;
        if (!regex.test(num)) {
            event.target.value = event.target.value.slice(0, -1);
            return 0;
        }

        const withOutCommas = num.replace(/,/g, '')
        return this.aextracapital = parseInt(withOutCommas);
    }

    getCuota(){
        if (this.capital <= 0) {
            return 0
        }
        return this.cuota;
    }

    getAinteres(){
        this.ainteres = this.interes * this.capital_residual;
        if (this.capital <= 0) {
            return 0
        }
        return this.ainteres;
    }

    getAcapital(){
        this.acapital = this.cuota - this.ainteres + this.aextracapital;
        if (this.capital <= 0) {
            return 0
        }
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
    nuevo_credito: new FilaPrestamo({}),
    aextracapitalAll : new FilaPrestamo({}),
    cuotaInicio: 1,
    cuotaFin: 1,
    cod_credito: null,
    credito: null,
    credito_edit: new FilaPrestamo({}),
    totalCreditoInicial: 0,
    cuotaPrestamo: 0,
    pagoTotalCredito: 0,
    pagoTotalCreditoMenosAbonos: 0,
    ahorroEstimado: 0,
    cuotas_ahorradas: 0,
    ahorroEstimadoPorcent: 0,
    imagenPremio: 'moto-flat.jpg',
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

            this.credito_edit = new FilaPrestamo({
                capital: response.credito.cantidad,
                interes: response.credito.interes,
                cuotas: response.credito.cuotas
            });

            this.totalCreditoInicial = this.credito.cantidad;
            this.generarTabla();

        },
        generarTabla(){
            this.tablaAmortizacion = [];
            const cantidad = this.credito.cantidad; // Valor iniciar del credito
            const interes = this.credito.interes / 100;
            const cuotas = this.credito.cuotas;

            const cuota_prestamo = ((cantidad * (interes*(1+interes) ** cuotas)) / (((1 + interes) ** cuotas) - 1));
            console.table(cantidad, interes, cuotas, cuota_prestamo);

            /* Fila de inicio */
            let filaInicio = new FilaPrestamo({
                capital: cantidad
            });

            this.tablaAmortizacion.push(filaInicio);

            let contador = 1;
            let capital_residual = filaInicio.capital;

            while (this.credito.cuotas >= contador) {

                let filaPrestamo = new FilaPrestamo({
                    mes: contador,
                    cuota: cuota_prestamo,
                    capital_residual,
                    interes
                });


                capital_residual = filaPrestamo.getCapital();

                this.cuotaPrestamo = cuota_prestamo
                this.tablaAmortizacion.push(filaPrestamo);
                contador++;
            }

            this.pagoTotalCredito = this.credito?.cuotas * this.cuotaPrestamo

            console.log(this.tablaAmortizacion);
        },
        reGenerateTable(){
            let capital_residual = 0;
            let cuotas_ahorradas = 0;
            let ahorroEstimado = 0

            this.tablaAmortizacion.forEach(async filaPrestamo => {

                if (filaPrestamo.cuota == 0) {
                    capital_residual = filaPrestamo.capital;
                }else{
                    filaPrestamo.capital_residual = capital_residual;
                    capital_residual = filaPrestamo.getCapital();

                    if (capital_residual <= 0) {
                        cuotas_ahorradas++;
                        ahorroEstimado += filaPrestamo.cuota;
                    }
                }
            });

            this.pagoTotalCredito = this.credito?.cuotas * this.cuotaPrestamo
            this.ahorroEstimado = ahorroEstimado;
            this.cuotas_ahorradas = cuotas_ahorradas;
            this.ahorroEstimadoPorcent = cuotas_ahorradas * 100 / this.credito.cuotas;
            this.pagoTotalCreditoMenosAbonos = this.pagoTotalCredito - this.ahorroEstimado;
        },
        aplicarAbonoAll(){
            if ((this.cuotaFin < 0 || this.cuotaInicio < 1) || this.cuotaFin > this.credito.cuotas || this.cuotaInicio > this.cuotaFin) {
                alert(`Ingrese cuotas dentro del rango 1 y ${this.credito.cuotas}`);
                return;
            }

            const range = Array( this.cuotaFin - this.cuotaInicio + 1).fill( this.cuotaInicio).map((x, y) => x + y)
            console.log(range);

            range.forEach( index => {
                if (index <= this.credito.cuotas && index >0) {
                    this.tablaAmortizacion[index].aextracapital = this.aextracapitalAll.aextracapital;
                }
            });


            this.reGenerateTable();
        },
        resetAplicarAbonoAll(){
            this.tablaAmortizacion.forEach(filaPrestamo => {
                filaPrestamo.aextracapital = 0;
            });
            this.reGenerateTable();
            this.ahorroEstimado = 0;
            this.ahorroEstimadoPorcent = 0;
        },
        async guardarAnalisis(){
            if (!confirm("Guardar cambios en el analisis?")) {
                return;
            }

            let dataBody = this.tablaAmortizacion.filter( filaPrestamo => {
                return filaPrestamo.aextracapital > 0;
            });

            if (dataBody.length < 1) {
                alert('No existen cuotas con abono de capital que registrar.');
                return;
            }

            console.log(JSON.stringify(dataBody));

            const response = await fetch(`http://ahorraplataentucredito.test/api/analisis`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(dataBody)
            })
            .then(response => {
                console.log(response);
                return response.json();
            }).catch( error => {
                console.error(error);
            });
            console.log(response)

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
        },
        checkPositiveValue: function (value) {
            if (value <=0) {
                return 0;
            }
            return value;
        },
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    },
    mounted(){
        this.cod_credito = document.querySelector('#hiddenCreditoID')?.value;
        if (this.cod_credito) {
            this.getTablaAnalisis();
        }

    }
})



