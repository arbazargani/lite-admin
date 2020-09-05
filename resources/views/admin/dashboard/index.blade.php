@extends('admin.template')

@section('content')
{{--
<div>
    <div class="uk-card uk-card-default uk-card-body flat-sherpa uk-light uk-border-rounded">
        <div class="uk">
            <div class="uk-float-right">
                <a uk-icon="icon: future" onclick="makeExchange()"></a>
            </div>
            <div class="uk-float-left">
                <div style="direction: ltr">

                    <span class="minimal-label">*
                    </span>
                    <input type="number" class="minimal-input" id="currency-number" name="currency-number" min="1" value="1">

                    <span class="minimal-label">From</span>
                    <select class="minimal-select" id="currency-in" name="currency-in">
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                    </select>

                    <span class="minimal-label">To</span>

                    <select class="minimal-select" id="currency-to" name="currency-to">
                        <option value="IRT">IRT</option>
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                    </select>

                    <div id="holder"></div>

                </div>
                <script>
                    function getSelectedCurrency(id) {
                        var e = document.getElementById(id);
                        var value = e.options[e.selectedIndex].value;
                        var text = e.options[e.selectedIndex].text;
                        return value;
                    }
                    function makeExchange() {
                        var from = getSelectedCurrency('currency-in');
                        var to = getSelectedCurrency('currency-to');
                        var number = document.getElementById('currency-number').value;
                        console.log("converting " + number + " from " + from + " to " + to);
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                if (response.ok == true) {
                                    document.getElementById("holder").innerHTML = response.price_to_tomans;
                                    console.log('done: ' + response.price_to_tomans);
                                } else {
                                    document.getElementById("holder").innerHTML = '<code>' + response.error + '<br/>[contact system administrator.]</code>';
                                }
                            }
                        };
                        xhttp.open("POST", "{{ route('CoinExchange') }}?in=" + from + "&to=" + to + "&number=" + number, true);
                        xhttp.send();
                    }
                </script>
            </div>
        </div>
    </div>
</div>
--}}

<div class="workspace-wrap">
    @content
</div>

@endsection
