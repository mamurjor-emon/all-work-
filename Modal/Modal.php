<style>
    .discount-content h5 {
        font-family: 'Hind Siliguri';
        font-weight: 600;
        word-spacing: 6px;
        line-height: 33px;
        color: #433c3c;
        margin-bottom: 5px;
        font-size: 22px;
    }

    .submit-button {
        background: #4fc087;
        padding: 10px 15px;
        margin: 32px 0px;
        border-radius: 5px;
        color: white;
        font-size: 15px;
        font-weight: 600;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #status_value {
        color: #9fa0a1 !important;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="discount_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-10">
        <div class="modal-content">
            <button type="button" class="btn-close border-0 mt-4 mb-2" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="container">
                <div class="row py-4 px-5 discountform">
                    <div class="discount-content mt-5 mb-4">
                        <h5>অফারটি সম্পর্কে জানতে নিম্নে প্রদত্ত ফর্মটি এখনই পূরণ করুন,
                            আমাদের প্রতিনিধি শীঘ্রই আপনার সাথে যোগাযোগ করবেঃ</h5>
                        <p>* অফারটি নির্দিষ্ট সময়ের জন্যই প্রযোজ্য থাকছে।</p>
                    </div>
                    <form action="#">
                        <div class="mb-3 col-md-12">
                            <input type="text" class="form-control" id="recipient-name" placeholder="Your Name">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 col-md-5">
                                <input type="text" class="form-control" id="recipient-name"
                                    placeholder="Phone Number">
                            </div>
                            <div class="mb-3 col-md-5">
                                <input type="text" class="form-control" id="recipient-name" placeholder="Profession">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="mb-3 col-md-5">
                                <input type="text" class="form-control" id="recipient-name" placeholder="Location">
                            </div>

                            @php
                                $courses = DB::table('courses')->get();
                            @endphp

                            <div class="mb-3 col-md-5 form-group">
                                <select class="form-control" id="status_value">
                                    <option value="">Couses Name</option>

                                    @forelse ($courses as $course)
                                        <option value="{{  $course->id  }}">{{ $course->title }}</option>
                                    @empty
                                        <p class="text-center text-danger">No Courses Avaiable !</p>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="submit-button" >SUBMIT NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
