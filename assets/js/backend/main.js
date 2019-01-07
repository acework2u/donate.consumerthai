var baseUrl = window.location.origin;

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
        }
    },
    methods: {
        getDonationlist() {
            let baseApi = baseUrl + "/api-01/report/donation-list";

            axios.get(baseApi).then((res) => {
                this.donationInfo = res.data
            }).catch((err) => {
            })
        }
    }


});
