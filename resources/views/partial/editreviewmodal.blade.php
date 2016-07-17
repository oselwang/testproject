<div class="modal fade" id="edit-review-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="active">Rate and Review</a>
                            <a href="#" id="close-edit-review-modal" style="float: right"><i class="fa fa-remove"></i> </a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" style="padding:1em;">
                            <form id="edit-review-form" action="{{url('http://testproject.net/edit-review')}}" method="post"
                                  role="form" style="display: block;" autocomplete="off">
                                <input type="hidden" name="review_id" value="{{$user_review->id}}">

                                <div id="flash-error-edit-review" class="alert alert-danger hidden">
                                    <ul id="error-edit-review" style="margin-left: 1em"></ul>
                                </div>

                                <strong class="choice">Choose a rating</strong>
                                <span class="star-rating">
                                    <input type="radio" name="rating" value="1" @if($user_review->rating == 1) checked @endif><i></i>
                                    <input type="radio" name="rating" value="2" @if($user_review->rating==2) checked @endif><i></i>
                                    <input type="radio" name="rating" value="3" @if($user_review->rating == 3)checked @endif><i></i>
                                    <input type="radio" name="rating" value="4" @if($user_review->rating == 4)checked @endif><i></i>
                                    <input type="radio" name="rating" value="5" @if($user_review->rating == 5)checked @endif><i></i>

                                </span>

                                <strong class="review">Your Review (optional)</strong>
                                <textarea placeholder="Do you like it? Why?" rows="8" name="review"
                                          class="form-control" maxlength="600" style="font-size: 18px">{{$user_review->review}}</textarea>
                                <div class="submit-review">
                                    <button id="submit-review" class="btn btn-default btn-review">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/rating.js')}}"></script>