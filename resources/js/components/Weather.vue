<script>
export default {
    data() {
        return {
            locations : [],
            city : 'Tokyo',
            weather : {
                temp : 0,
                icon : '',
                type : '',
                desc : '',
            },
            forecast : []
        }
    },
    created() {
        this.getLocations();
        this.getWeatherInfo('Tokyo')
    },
    methods: {
        getWeatherInfo(city) {
            this.city = city;
            let url = 'weather/' + city;
            axios.get(this.URL + url).then((response) => {
                let data = response.data.data;
                this.weather = {
                    temp : data.main.temp,
                    icon : data.weather[0].icon,
                    type : data.weather[0].main,
                    desc : data.weather[0].description,
                }

                this.getWeatherForecast(city);
            });
        },
        getWeatherForecast(city) {
            this.city = city;
            let url = 'weather/forecast/' + city;
            axios.get(this.URL + url).then((response) => {

                let forecasts = [];
                let data = response.data.data.list || [];

                data = data.slice(0,5); //Get only 5

                data.forEach(data => {
                    let temp = {
                        date : data.dt,
                        temp : data.main.temp,
                        temp_min : data.main.temp_min,
                        temp_max : data.main.temp_max,
                        icon : data.weather[0].icon,
                        type : data.weather[0].main,
                        desc : data.weather[0].description,

                    }
                    forecasts.push(temp);
                })

                this.forecast = forecasts;
            });
        },
        parseDate(date)
        {
            let timestamp = date;
            let xx = new Date();
            let days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            var hour = xx.getHours();
            var min = xx.getMinutes();
            xx.setTime(timestamp*1000);
            return days[xx.getDay()] + " " + hour + ":" + min;
        },
        getLocations() {
            let url = 'location';
            axios.get(this.URL + url).then((response) => {
                this.locations = response.data.data;
            });
        },
    },
    watch:{
    }
}
</script>

<template>
    <div class="container text-white">
        <div class="row justify-content-between py-5">
            <div class="col text-center">
                <div class="dropdown">
                    <button class="btn btn-light" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        =
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li v-for="(city) in locations"><button class="dropdown-item" type="button" @click = getWeatherInfo(city)>{{ city }}</button></li>
                    </ul>
                </div>
            </div>
            <div class="col text-center">
                <h1 class="display-6">{{city}}</h1>
            </div>
            <div class="col text-center">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-1">{{weather.temp}}°</h1>
            </div>
            <div class="col-12 text-center">
                <div class="">
                    <span class="fs-5 d-inline-flex">{{weather.type}}</span>
                </div>
                <div class="">
                    <img v-bind:src="'https://openweathermap.org/img/w/' + weather.icon + '.png'" alt="cloud"/>
                    <span class="fs-6 d-inline-flex">{{weather.desc}}</span>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div v-for="(weather) in forecast" class="col-12 text-center m-1">
                <div class="float-start">
                    <img v-bind:src="'https://openweathermap.org/img/w/' + weather.icon + '.png'" alt="cloud"/>
                    <span>{{parseDate(weather.date)}} - </span>
                    <span class="fs-6 d-inline-flex">{{weather.type}}</span>
                </div>
                <div class="float-end">
                    <div>
                        {{weather.temp_max}}° / {{weather.temp_min}}°
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
