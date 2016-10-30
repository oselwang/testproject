<div class="modal fade" id="recipe-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="active" id="register-form-link">Write Your Own Recipe !</a>
                            <a href="#" id="close-recipe-modal" style="float: right"><i class="fa fa-remove"></i> </a>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" style="padding:1em;">
                            <form id="recipe-form" action="{{url('http://testproject.com/addrecipe')}}" method="post"
                                  role="form" style="display: block;" autocomplete="off">
                                {{csrf_field()}}

                                <div id="flash-error-recipe" class="alert alert-danger hidden">
                                    <ul id="error-recipe" style="margin-left: 1em">
                                    </ul>
                                </div>

                                <div class="input-group image-preview" style="margin-bottom:30px;">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled"
                                           style="height: 34px;" placeholder="Profile Photo">
                                    <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear"
                                                    style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                        <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title" id="image-preview-input-title">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif"
                                                       name="profilephoto">
                                                <!-- rename it -->
                                            </div>
                                        </span>
                                </div>

                                <div class="form-group" style="margin-bottom:30px;">
                                    <input type="text" name="recipename" tabindex="1" class="form-control"
                                           placeholder="Recipe Name">
                                </div>

                                <div class="form-group" style="margin-bottom:30px;">
                                    <textarea name="description" class="form-control"
                                              placeholder="Description" tabindex="1"></textarea>
                                </div>

                                <div class="form-group" style="display: inline-block;width:49.7%;">
                                    <select class="form-control" name="portion" tabindex="1">
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

                                <div class="form-group" style="display:inline-block;width:49.7%;">
                                    <select class="form-control" name="difficulty" tabindex="1">
                                        <option value="">Difficulty</option>
                                        <option value="easy">Easy</option>
                                        <option value="medium">Medium</option>
                                        <option value="hard">Hard</option>
                                    </select>
                                </div>

                                <div class="form-group" style="display:inline-block;width:49.7%;">
                                    <select class="form-control" name="duration" tabindex="1">
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

                                <div class="form-group" style="display:inline-block;width:49.7%;">
                                    <select class="form-control" name="preparation" tabindex="1">
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

                                <div class="form-group" id="ingredient-form-recipe-modal">
                                    <div id="ingredient-temp">
                                        <input type="text" name="ingredient[]" maxlength="50" id="ingredient"
                                               class="form-control" tabindex="1"
                                               placeholder="Ingredient" style="display:inline-block;width:47.2%;">
                                        <input type="text" name="amount[]" maxlength="50" id="amount"
                                               class="form-control"
                                               placeholder="Amount" style="display:inline-block;width:37.2%;"
                                               tabindex="1">
                                        <input type="text" name="unit[]" disabled style="display: inline-block;width: 10%;margin-left: -4px" value="gram" class="form-control">
                                        <button type="button" class="btn btn-danger" data-type="plus"
                                                id="minus-ingredient"
                                                style="display:inline-block;">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <div class="ingredient-suggestion-container-recipe-modal hidden">

                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" data-type="plus" id="plus-ingredient" style="margin-bottom: 20px">
                                    <span class="glyphicon glyphicon-plus">Add Ingredient Row</span>
                                </button>
                                <div class="form-group">
                                    <div id="instruction-temp1">
                                    <textarea name="instruction[]" id="instruction" class="form-control"
                                              placeholder="Instruction" tabindex="1"
                                              style="display:inline-block;width:94.8%;"></textarea>
                                        <button type="button" class="btn btn-danger" data-type="plus"
                                                id="minus-instruction" style="margin-bottom:30px">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </div>
                                    <div id="instruction-temp">

                                    </div>
                                    <button type="button" class="btn btn-success" data-type="plus"
                                            id="plus-instruction">
                                        <span class="glyphicon glyphicon-plus">Add Instruction Row</span>
                                    </button>
                                </div>

                                <center><h3 style="margin-bottom: 30px">Category</h3></center>
                                @foreach($all_category as $category)
                                    <div class="checkbox-inline recipe-category" style="margin-left: 10px">
                                        <label><input type="checkbox" name="recipecategory[]"
                                                      value="{{$category->id}}">{{$category->category_name}}</label>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3" style="margin-top:30px">
                                            <input type="submit" id="create-recipe"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Create Recipe">
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
<script src="{{asset('js/recipemodal.js')}}"></script>
