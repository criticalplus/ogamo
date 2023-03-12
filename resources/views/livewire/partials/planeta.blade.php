<div class="max-w-7xl mx-auto sm:px-2 lg:px-4">

    <h2 class="text-center mb-2">Has elegido el universo {{$sesion['userUniverso']['name']}} número {{$sesion['userUniverso']['id']}}</h2>
                        
    <div class="grid grid-cols-2 gap-4">


        <div class="">
            <code>
                PLANETA {{$sesion['userPlaneta']['nombre']}}
                <br>
                POSICIÓN RESP. ESTRELLA {{$sesion['userPlaneta']['pos']}}
                <br>
                TIPO PLANETA {{$sesion['userPlaneta']['tipo']}}
                <br>
                HABITABLE {{$sesion['userPlaneta']['habitable']}}
                <br>
                ATMOSFERA {{$sesion['userPlaneta']['atmosfera']}}
                <br>
                BIOMA {{$sesion['userPlaneta']['bioma']}}
                <br>
                TAMAÑO {{$sesion['userPlaneta']['magnitud']}}
                <br>
                <br>
            </code>
        </div>
        <div class="">
            <code>
                SISTEMA Nº {{$sesion['planetaSistema']['id']}}
                <br>
                N. ESTRELLAS {{$sesion['planetaSistema']['num_estrellas']}}
                <br>
                TIPO ESTRELLAS {{$sesion['planetaSistema']['tipo_estrellas']}}
                <br>
                POSICIÓN {{$sesion['planetaSistema']['posY']}}/{{$sesion['planetaSistema']['posZ']}}
                <br>
                <br>
            </code>
        </div>

    </div>

    <div>


    </div>

</div>