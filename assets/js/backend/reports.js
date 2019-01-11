var baseUrl = window.location.origin;

var date = new Date(), y = date.getFullYear(), m = date.getMonth();
var firstDay = new Date(y, m, 1);
var lastDay = new Date(y, m + 1, 0);


Vue.use(VueTables.ClientTable);
Vue.component('pagination', Pagination);

Vue.filter('formatBaht', (value) => {
    if (value) {

        let string = numeral(value).format('0,0.00')

        return string
    }
});

var appreport = new Vue({
    el: "#appreport",
    data() {
        return {
            donationInfo: [],
            bankList: [],
            paymentCode: [],
            userClicked: {},
            title: "Donation Report",
            columns: ['inv_number', 'campaign_name', 'amount', 'transfer_date', 'status', 'first_name', 'tranRef', 'paymentchanel', 'pan', 'bankName','updated_date', 'action'],
            options: {
                headings: {
                    inv_number: 'Invoice No.',
                    campaign_name: 'Campaign',
                    amount: 'View Record',
                    transfer_date: 'Transfer Date',
                    note: 'Status',
                    first_name: 'Donor',
                    tranRef: 'Transaction No.',
                    paymentchanel: 'Channel',
                    pan: 'Card',
                    bankName: 'Bank',
                    updated_date:"Updated",

                    action: "",

                },
                pagination: {chunk: 10},
                sortable: ['inv_number', 'first_name', 'tranRef'],
                filterable: ['inv_number', 'first_name', 'tranRef'],
                perPage: 10,
                perPageValues: [10, 25, 50, 100, 500, 1000],

            },


            time: new Date(),
            startTime: firstDay,
            endTime: lastDay,
            range: [firstDay, lastDay],
            emptyTime: '',
            tranferDateTime: '',
            emptyRange: [],
            currentTime: null,
            local: {
                dow: 0, // Sunday is the first day of the week
                hourTip: 'Select Hour', // tip of select hour
                minuteTip: 'Select Minute', // tip of select minute
                secondTip: 'Select Second', // tip of select second
                yearSuffix: '', // suffix of head year
                monthsHead: 'January_February_March_April_May_June_July_August_September_October_November_December'.split('_'), // months of head
                months: 'Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec'.split('_'), // months of panel
                weeks: 'Su_Mo_Tu_We_Th_Fr_Sa'.split('_'),// weeks,
                cancelTip: 'cancel',
                submitTip: 'confirm'
            }
        }
    }, created() {
        this.getDonationlist()
        this.getBankList()
        this.getPaymentCode()
    },
    mounted() {
        this.$nextTick(() => {
            this.getDonationlist()
            this.getBankList()
            this.getPaymentCode()

        })
    },
    computed: {
        filterDonationList() {
            return this.donationInfo
        },
        filDonateTotal() {
            let total = 0
            return this.donationInfo.reduce((total, value) => {
                return total + Number(value.amount)
            }, 0)
        },
        totalSuccess() {
            let total = 0
            return this.donationInfo.reduce((total, value) => {

                if (value.payment_status == "00" || value.payment_status == "000") {
                    total = total + Number(value.amount)
                }
                return total
            }, 0)
        },
        totalPending() {
            let total = 0
            return this.donationInfo.reduce((total, value) => {
                if (value.payment_status == "001") {
                    total = total + Number(value.amount)
                }
                return total
            }, 0)
        },
        totalCancle() {
            let total = 0
            return this.donationInfo.reduce((total, value) => {
                if (value.payment_status !== "001" && value.payment_status !== "000" && value.payment_status !== "00") {
                    total = total + Number(value.amount)
                }
                return total
            }, 0)
        },
        fillterDateTime() {
            this.startTime = this.range[0]
            this.endTime = this.range[1]
        },
        filterPyamentStatus() {
            return this.paymentCode.filter((paycode) => {
                if (this.userClicked.payment_channel === "01" || this.userClicked.payment_channel === "001") {
                    if (paycode.use_type === "2") {
                        return paycode
                    }
                } else {
                    if (paycode.use_type === "1") {
                        return paycode
                    }

                }


            })
        },
        filterPaymentS() {
            let payStatus = this.userClicked

            if (payStatus.payment_status === "00" || payStatus.payment_status == "000") {
                return true
            } else {
                return false;
            }

        },

    },
    methods: {
        getDonationlist() {
            let baseApi = baseUrl + "/api-01/report/donation-list";
            let stDate = this.startTime
            let endDate = this.endTime
            axios.get(baseApi).then((res) => {
                this.donationInfo = res.data
            }).catch((err) => {
            })
        },
        getBankList() {
            let baseApi = baseUrl + "/api-v01/banklist";
            axios.get(baseApi).then((res) => {
                this.bankList = res.data
            }).catch((err) => {
            })
        },
        getPaymentCode() {
            let baseApi = baseUrl + "/api-v01/payment-status-code";
            axios.get(baseApi).then((res) => {
                this.paymentCode = res.data
            }).catch((err) => {
            })
        },
        confrim: function () {
            // console.log(this.startTime);
            // console.log(this.endTime);

            this.startTime = this.range[0]
            this.endTime = this.range[1]

            // console.log(this.range);
        },
        invoice(donationId) {
            return baseUrl + "/admin/reports/get-invoice/" + donationId
        },
        donationUpdate() {
            let baseApi = baseUrl + "/admin/reports/update-donation";
            if (this.emptyTime) {
                this.userClicked.transfer_date = this.date2server(this.emptyTime);
            }

            let dataInfo = this.userClicked
            var fromData = this.toFormData(dataInfo)

            axios.post(baseApi, fromData).then((res) => {
                console.log(res.data);

                this.getDonationlist()

            }).catch((err) => {

            })
            appreport.getDonationlist()


        },
        donationEdit(itemClick) {
            this.userClicked = itemClick
            console.log(this.userClicked)
        },
        toFormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
        moment: function (date) {
            return moment(date);
        },
        date: function (date) {
            return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        },
        date2server(date1) {
            // let date2 =  moment(date1).utcOffset(7)
            // return moment.utc(date2).format('YYYY.MM.DD H:mm:ss')
            return moment(date1).format('YYYY-MM-DD H:mm:ss')
        },
        covertDatetime() {
            // if(!this.emptyTime){
            //
            // }

            // console.log(this.emptyTime)
        }


    }
});


