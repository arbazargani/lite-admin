<script>
    function doJob() {
        // const axios = require('axios');
        axios = axios;

        // Make a request for a user with a given ID
        axios.get('http://localhost:8000/coin/buy?currency-in=BTCUSDT&amount=121')
        .then(function (response) {
            // handle success
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            console.log(response);
            
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
            console.log(response);
        });
    }
    async function getUser() {
        try {
            const response = await axios.get('http://127.0.0.1:8000/redis');
            console.log(response);
        } catch (error) {
            console.error(error);
        }
    }

    function HandleThat() {
        getUser();
        doJob();
    }
</script>