<link rel="stylesheet" type="text/css" href="<?php asset('css/bootstrap.css')?>">
    <div class="container">

        <div class="contact">
            <div class="contact-md">
                <center><h3>{{$user->present()->fullname}}</h3></center>
            </div>

            <img src="{{$recipe->photo_name}}" style="height: 300px;width: 300px ">

            <blockquote>
                <p>{{$recipe->name}}</p>
                Portion     :&nbsp;&nbsp;{{$recipe->portion}}&nbsp;&nbsp;&nbsp;&nbsp;
                Preparation : &nbsp;&nbsp;{{$recipe->preparation}} Minute&nbsp;&nbsp;&nbsp;&nbsp;
                Category    :&nbsp;&nbsp;@foreach($categories as $category) {{$category->category_name}} @endforeach
                <br><br>
                Email :{{$user->email}}
                <br>
                <br><i class="glyphicon glyphicon-pencil"></i>
                Written By : {{$user->present()->fullname}}<br>
                <br>Phone :{{$user->phone}}
                <br><p style="font-size:20px;color:grey;">Ingredient :</p>
            </blockquote>

            <table class="table table-striped custab" style="width:300px" align="center">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Ingredient Name</th>
                    <th>Amount</th>

                </tr>
                </thead>

                @for($i = 0; $i < count($ingredients);$i++)
                    <tr>
                        <td>{{$i + 1}}</td><td>{{$ingredients[$i]->name}}</td><td>{{$ingredients[$i]->amount}}</td>
                    </tr>
                @endfor
            </table>


            <br><p style="font-size:20px;color:grey;margin-left:40px">Instruction :</p>

            <table class="table table-striped custab" style="width:400px" align="center">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Instruction</th>
                </tr>
                </thead>

                @for($i = 0; $i < count($instructions);$i++)

                    <tr>
                        <td>{{$i+1}}</td><td>{{$instructions[$i]->body}}</td>
                    </tr>
                @endfor
            </table>