<div class="modal fade" id="recipe-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="active" id="register-form-link">Write Your Own Recipe !</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" style="padding:1em;">
                            <form id="recipe-form" action="addrecipe" method="post"
                                  role="form" style="display: block;">
                                <input type="hidden" name="_token" value="{{str_random(40)}}">
                                <div id="flash-error-login" class="alert alert-danger hidden">
                                    <ul id="error-register">
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="recipename" tabindex="1" class="form-control"
                                           placeholder="Recipe Name" value="{{old('recipename')}}">
                                </div>
                                <div class="form-group" style="display: inline-block;width:49%;">
                                    <select class="form-control" name="portion">
                                        <option value="">Portion</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>

                                <div class="form-group" style="display:inline-block;width:49%;">
                                    <select class="form-control" name="difficulty">
                                        <option value="">Difficulty</option>
                                        <option value="easy">Easy</option>
                                        <option value="medium">Medium</option>
                                        <option value="hard">Hard</option>
                                    </select>
                                </div>

                                <div class="form-group" style="display:inline-block;width:49%;">
                                    <select class="form-control" name="duration">
                                        <option value="">Duration(Minute)</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">25</option>
                                        <option value="30">30</option>
                                        <option value="60">60</option>
                                        <option value="90">90</option>
                                        <option value="120">120</option>
                                        <option value="150">150</option>
                                        <option value="180">180</option>
                                    </select>
                                </div>

                                <div class="form-group" style="display:inline-block;width:49%;">
                                    <select class="form-control" name="preparation">
                                        <option value="">Preparation(Minute)</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">25</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="ingredient[]" maxlength="50" id="ingredient" class="form-control"
                                              placeholder="Ingredient" style="display:inline-block;width:44%;">
                                    <input type="text" name="amount[]" maxlength="50" id="amount" class="form-control"
                                           placeholder="Amount" style="display:inline-block;width:44%;">
                                    <button type="button" class="btn btn-success" data-type="plus" id="plusingredient" style="display:inline-block;width:10%;padding:0.7em">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    <div id="ingredienttemp">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea name="instruction[]" maxlength="50" id="instruction" class="form-control"
                                              placeholder="Instruction" style="display:inline-block;width:88.5%;"></textarea>
                                    <button type="button" class="btn btn-success" data-type="plus" id="plusinstruction" style="display:inline-block;width:10%;margin-bottom: 30px;padding:0.7em">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    <div id="instructiontemp">

                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Register Now">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function redirect(url) {
        window.location = url;
    }

    $('#recipe-form').find('[name="difficulty"], [name="portion"],[name="duration"],[name="preparation"]').combobox().end();

    $('#plusinstruction').click(function () {
        $('#instructiontemp').append('<div id="textarea"><textarea name="instruction[]" maxlength="50" class="form-control" placeholder="Instruction" style="display:inline-block;width:88.5%;"></textarea><button type="button" class="btn btn-danger" data-type="plus" id="minusinstruction" style="display:inline-block;width:10%;margin-bottom: 30px;margin-left: 3px;padding: 0.7em"> <span class="glyphicon glyphicon-minus"></span></button></div>');
    });

    $('#instructiontemp').on('click', '#minusinstruction', function () {
        $(this).parent().remove();
    })
</script>