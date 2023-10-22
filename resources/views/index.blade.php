<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <title>Laravel</title>
        <style>
            .zag {
                margin-bottom: 50px;
            }

            .zag div {
                color: red;
            }

            .content {
                padding: 20px 0;
            }

            ol {
                list-style-type: none; 
                counter-reset: num;
                margin: 0 0 0 45px;
                padding: 15px 0 5px 0;
                font-size: 16px;
            }

            ol li {
                position: relative;	
                margin: 0 0 0 0;
                padding: 0 0 10px 0;
                line-height: 1.4;
            }

            ol li:before {
                content: counter(num); 
                counter-increment: num;
                display: inline-block;
                position: absolute;
                top: 0;
                left: -38px;
                width: 28px;
                height: 28px;
                background: #fff;
                color: #000;
                text-align: center;
                line-height: 28px;
                font-size: 18px;
                border-radius: 50%;
                border: 1px solid #ef6780;
            }
        </style>
 
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <form action="http://127.0.0.1:8000/print" method="POST">
                     @csrf
                     <input type="submit" value="Скачать CSV" class="btn btn-success" id="download">
                </form>
            </div>
            <div class="row zag">
                <div class="col-sm number">
                    Номер места
                </div>
                <div class="col-sm name">
                    Имя пилота
                </div>
                <div class="col-sm city">
                    Город пилота
                </div>
                <div class="col-sm car">
                    Автомобиль
                </div>
                <div class="col-sm attempt">
                    Попытки
                </div>
                <div class="col-sm sum">
                    Сумма очков
                </div>
            </div>
            @foreach ($results as $result)
            <div class="row content">
                <div class="col-sm">
                    {{ $result['number'] }}
                </div>
                <div class="col-sm">
                   {{ $result['name'] }}
                </div>
                <div class="col-sm">
                {{ $result['city'] }}
                </div>
                <div class="col-sm">
                {{ $result['car'] }}
                </div>
                <div class="col-sm">
                    <ol>
                    @foreach($result['results'] as $item)
                        <div class="col-sm">
                                <li>{{ $item }}</li>
                        </div>
                    @endforeach
                    </ol>
                </div>
                <div class="col-sm">
                    {{ $result['result_sum'] }}
                </div>
            </div>
            @endforeach
        </div>
        <script>
            btn = document.getElementById('download');
            btn.addEventListener('click', function() {
                location.reload()
            });
        </script>
    </body>
</html>
