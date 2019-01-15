var baseUrl = window.location.origin;
Vue.filter('formatBaht', (value) => {
    if (value) {

        let string = numeral(value).format('0,0.00')

        return string
    }
});

var lastdonate = new Vue({
    el: "#lastdonate",
    data() {
        return {
            title: "Last Donate",
            donationInfo: [],
        }
    },
    created() {
        this.getDonationlist()
    },
    mounted() {
        this.$nextTick(() => {
            this.getDonationlist()
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
    },
    methods: {
        getDonationlist() {
            let baseApi = baseUrl + "/api-01/report/donation-list";

            axios.get(baseApi).then((res) => {
                this.donationInfo = res.data.donationlist
            }).catch((err) => {
            })
        }
    }


});
