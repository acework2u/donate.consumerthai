var baseUrl = window.location.origin;

var date = new Date(), y = date.getFullYear(), m = date.getMonth();
var firstDay = new Date(y, m, 1);
var lastDay = new Date(y, m + 1, 0);



Vue.use(VueTables.ClientTable);
Vue.component('pagination', Pagination);

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
            columns: ['inv_number', 'campaign_name', 'amount','updated_date','note','first_name','tranRef','paymentchanel','pan','bankName','action'],
            options: {
                headings: {
                    inv_number: 'Invoice No.',
                    campaign_name: 'Campaign',
                    amount: 'View Record',
                    updated_date: 'Transfer Date',
                    note: 'Status',
                    first_name: 'Donor',
                    tranRef: 'Ref No.',
                    paymentchanel: 'Channel',
                    pan: 'Card',
                    bankName: 'Bank',

                    action:"",

                },
                pagination: { chunk:10 },
                sortable: ['inv_number', 'first_name','tranRef'],
                filterable: ['inv_number', 'first_name','tranRef'],
                perPage:100,
                perPageValues: [10,25,50,100,500,1000],

            },


            time: new Date(),
            startTime: firstDay,
            endTime: lastDay,
            range: [firstDay,lastDay],
            emptyTime: '',
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
        },
        fillterDateTime(){
            this.startTime = this.range[0]
            this.endTime = this.range[1]
        }
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
        confrim:function(){
            // console.log(this.startTime);
            // console.log(this.endTime);

            this.startTime = this.range[0]
            this.endTime = this.range[1]

            // console.log(this.range);
        },
        invoice(donationId){
            return baseUrl+"/admin/reports/get-invoice/"+donationId
        }




    }
});


