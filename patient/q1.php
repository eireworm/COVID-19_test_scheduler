<h1 style="font-size: 2rem;">Is your contact information up to date?</h1>
<br>
<input type="radio" id="q1_yes_radio" name="q1_radio" value="yes" onchange="toggleFormVisibility();" style="height:1.5rem; width:1.5rem;" checked="checked">
<label for="q1_yes_radio" style="font-size:2rem; margin-left: 15px;">Yes</label>
<br>
<br>
<input type="radio" id="q1_no_radio" name="q1_radio" value="no" onchange="toggleFormVisibility();" style="height:1.5rem; width:1.5rem;">
<label for="q1_no_radio" style="font-size:2rem; margin-left: 15px;">No</label>
<br>
<br>
<form method="post">
    <div id="updateContactInfoForm" style="display:none;">
        <label for="email"><strong>Email</strong></label>
        <br />
        <input type="email" id="emailField" class="input_box_style" name="email" />

        <br />
        <br />
        
        <label for="phone-number"><strong>Phone number</strong></label>
        <br />
        <input type="tel" id="phoneField" class="input_box_style" name="phone-number" pattern="[0-9]{10}" />
        <br />
        <small>Format: 0831011390</small>
    </div>

    <br>
    <br>

    <button type="submit" class="bttn" name="scheduler_back_bttn"><strong>Back</strong></button>
    <button type="submit" class="bttn" style="margin-left:20px;" name="scheduler_next_bttn"><strong>Next</strong></button>
</form>

<script>
// toggle update contact info field based on radio button value
function toggleFormVisibility() {
    var updateForm = document.getElementById("updateContactInfoForm");
    if (updateForm.style.display === "none") {
        updateForm.style.display = "block";
    } else {
        document.getElementById("emailField").value = "";
        document.getElementById("phoneField").value = "";
        updateForm.style.display = "none";
    }
}
</script>