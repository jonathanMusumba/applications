<!-- Review & Submit Form -->
<form id="reviewSubmitForm" method="POST" action="submit_review.php" class="border p-4 rounded shadow-sm">
<h3>Submit Your Application Form</h3>
        <p>Click on the text below to consent and submit your form:</p>
        <p>
        <label>
            <input type="checkbox" id="consentCheckbox">
        </label>
            I <strong><?php echo htmlspecialchars($fullName); ?></strong>, declare that to the best of my knowledge the information I have provided here is true and I agree to the online application terms and conditions of use.
        </p>
       
        <br><br>
        <button type="submit" id="submitButton" disabled>Submit</button>
</form>
