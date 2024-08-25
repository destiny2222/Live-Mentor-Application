<div >
    
    <form class="form2" id="coupon_form" wire:submit.prevent="save" name="contact_form" method="post">
        @csrf
        <div class="row py-5">
            <div class="col-sm-12 mb-5">
                <h4>I prefer</h4>
                <div class="d-flex gap-3">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" wire:model="prefer" value="human" id="flexRadioDefault4">
                        <label class="form-check-label ps-3" for="flexRadioDefault4">Human mentor</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" onclick="AI()" wire:model="prefer" value="ai" id="flexRadioDefault5">
                        <label class="form-check-label ps-3" for="flexRadioDefault5">AI Mentor</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb25">
                    <h6 class="mb15">Language *</h6>
                    <div class="bootselect-multiselect">
                        <select wire:model="language" class="selectpicker" data-placeholder="Choose a Language...">
                            <option value="Afrikaans">Afrikaans</option>
                            <option value="Albanian">Albanian</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Armenian">Armenian</option>
                            <option value="Basque">Basque</option>
                            <option value="Bengali">Bengali</option>
                            <option value="Bulgarian">Bulgarian</option>
                            <option value="Catalan">Catalan</option>
                            <option value="Cambodian">Cambodian</option>
                            <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                            <option value="Croatian">Croatian</option>
                            <option value="Czech">Czech</option>
                            <option value="Danish">Danish</option>
                            <option value="Dutch">Dutch</option>
                            <option value="English">English</option>
                            <option value="Estonian">Estonian</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finnish">Finnish</option>
                            <option value="French">French</option>
                            <option value="Georgian">Georgian</option>
                            <option value="German">German</option>
                            <option value="Greek">Greek</option>
                            <option value="Gujarati">Gujarati</option>
                            <option value="Hebrew">Hebrew</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Hungarian">Hungarian</option>
                            <option value="Icelandic">Icelandic</option>
                            <option value="Indonesian">Indonesian</option>
                            <option value="Irish">Irish</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Javanese">Javanese</option>
                            <option value="Korean">Korean</option>
                            <option value="Latin">Latin</option>
                            <option value="Latvian">Latvian</option>
                            <option value="Lithuanian">Lithuanian</option>
                            <option value="Macedonian">Macedonian</option>
                            <option value="Malay">Malay</option>
                            <option value="Malayalam">Malayalam</option>
                            <option value="Maltese">Maltese</option>
                            <option value="Maori">Maori</option>
                            <option value="Marathi">Marathi</option>
                            <option value="Mongolian">Mongolian</option>
                            <option value="Nepali">Nepali</option>
                            <option value="Norwegian">Norwegian</option>
                            <option value="Persian">Persian</option>
                            <option value="Polish">Polish</option>
                            <option value="Portuguese">Portuguese</option>
                            <option value="Punjabi">Punjabi</option>
                            <option value="Quechua">Quechua</option>
                            <option value="Romanian">Romanian</option>
                            <option value="Russian">Russian</option>
                            <option value="Samoan">Samoan</option>
                            <option value="Serbian">Serbian</option>
                            <option value="Slovak">Slovak</option>
                            <option value="Slovenian">Slovenian</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Swahili">Swahili</option>
                            <option value="Swedish ">Swedish </option>
                            <option value="Tamil">Tamil</option>
                            <option value="Tatar">Tatar</option>
                            <option value="Telugu">Telugu</option>
                            <option value="Thai">Thai</option>
                            <option value="Tibetan">Tibetan</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Turkish">Turkish</option>
                            <option value="Ukrainian">Ukrainian</option>
                            <option value="Urdu">Urdu</option>
                            <option value="Uzbek">Uzbek</option>
                            <option value="Vietnamese">Vietnamese</option>
                            <option value="Welsh">Welsh</option>
                            <option value="Xhosa">Xhosa</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb25">
                    <h6 class="mb15">Avaliable Time *</h6>
                    <input type="time" wire:model="time" id="" placeholder="" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb25">
                    <h6 class="mb15">End Time *</h6>
                    <input type="time" wire:model="end_time" id="" placeholder="" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb25">
                    <h6 class="mb15">Avaliable Days *</h6>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day"  value="Monday" id="monday">
                        <label class="form-check-label ps-3" for="monday">Monday</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day"  value="Tuesday" id="tuesday">
                        <label class="form-check-label ps-3" for="tuesday">Tuesday</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day" value="Wednesday" id="wednesday">
                        <label class="form-check-label ps-3" for="wednesday">Wednesday</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day" value="Thursday" id="thursday">
                        <label class="form-check-label ps-3" for="thursday">Thursday</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day" value="Friday" id="friday">
                        <label class="form-check-label ps-3" for="friday">Friday</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day" value="Saturday" id="saturday">
                        <label class="form-check-label ps-3" for="saturday">Saturday</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" wire:model="day" value="Sunday" id="sunday">
                        <label class="form-check-label ps-3" for="sunday">Sunday</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="mb25">
                    <h4 class="mb15" class="mb15">Additional information</h4>
                    <h6>Order Notes (optional)</h6>
                    <textarea wire:model="form_message" class="" rows="7" placeholder="Description"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="d-grid default-box-shadow2">
                    <button class="ud-btn btn-thm" wire:click="$set('save_find', true)" type="submit">Save And Find Tutor<i class="fal fa-arrow-right-long"></i></button>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="d-grid default-box-shadow2">
                    <button class="ud-btn btn-thm" wire:click="$set('save_request', true)" type="submit">Save And Send Request to Tutor<i class="fal fa-arrow-right-long"></i></button>
                </div>
            </div>
        </div>
        
    </form>
</div>
@push('scripts')

@endpush

<script>
    function AI(){
        alert("UNAVAILABLE! Please choose another prefer?") 
    }
</script>


