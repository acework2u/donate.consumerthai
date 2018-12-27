var baseUrl = window.location.origin;

Vue.filter('formatBaht',(value)=>{
    if(value){
        let string = numeral(value).format('0,0.00')

        return string
    }
});


var appreport = new Vue({
    el: "#appreport",
    data() {
        return {
            donationInfo: [],
            userClicked: {},
            title: "Donation Report",
            time: new Date(),
            startTime: "",
            endTime: "",
            local: {
                dow: 7, // Sunday is the first day of the week
                hourTip: 'Select Hour', // tip of select hour
                minuteTip: 'Select Minute', // tip of select minute
                secondTip: 'Select Second', // tip of select second
                yearSuffix: '', // suffix of head
                monthsHead: 'January_February_March_April_May_June_July_August_September_October_November_December'.split('_'), // months of head
                months: 'Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec'.split('_'), // months of panel
                weeks: 'Su_Mo_Tu_We_Th_Fr_Sa'.split('_'), // weeks,
                cancelTip: 'Cancel', // text for cancel button for daterange picker
                submitTip: 'Submit' // text for submit button for daterange picker
            },
            currentTime: null
        }
    }, created() {
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
        filDonateTotal(){
            let total =0
            return this.donationInfo.reduce((total,value)=>{
                return total+ Number(value.amount)
            },0)
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


