<?php 
    include('includes/layout-header.php');
?>

<?php include('includes/scripts.php')?>

<main style="display: flex; gap: 20px; justify-content: center; margin: 30px 0; padding: 20px; background-image: linear-gradient( 109.6deg,  rgba(254,253,205,1) 11.2%, rgba(163,230,255,1) 91.1% );">
    <div style="max-width: 350px;">
        <img src="assets/images/student.png" alt="Discount 1" style="width: 100%; height: auto;">
        <h2>Students - 20% Discount</h2>
        <p class="discount-summary">Enjoy a 20% discount year-round. Present a valid student ID or school registration card.</p>
        <button class="read-more-btn" onclick="togglePopup('student-popup')">Read More</button>
    </div>

    <div style="max-width: 350px;">
        <img src="assets/images/senior.png" alt="Discount 2" style="width: 100%; height: auto;">
        <h2>Senior Citizens - 20% Discount</h2>
        <p class="discount-summary">To avail of the 20% discount, present your Senior Citizen ID or valid document proving age.</p>
        <button class="read-more-btn" onclick="togglePopup('senior-popup')">Read More</button>
    </div>

    <div style="max-width: 350px;">
        <img src="assets/images/pwd.jpg" alt="Discount 3" style="width: 100%; height: auto;">
        <h2>PWD (Person with Disability) - 20% Discount</h2>
        <p class="discount-summary">Present your PWD ID upon ticket purchase to avail of the 20% discount.</p>
        <button class="read-more-btn" onclick="togglePopup('pwd-popup')">Read More</button>
    </div>
</main>

<!-- Popups for additional information -->
<div id="student-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close" onclick="closePopup('student-popup')">&times;</span>
        <img src="assets/images/student.png" alt="Discount 1" style="width: 100%; height: auto;">
        <h2>Students - 20% Discount</h2>
        <p>Enjoy a 20% discount year-round, including during summer breaks and legal holidays. To qualify, present a valid student ID or school registration card with your name, photo, and school details. Remember, no ID means no discount. Please note that students in medicine proper, law, graduate courses, and short-term programs are not eligible for this discount.</p>
    </div>
</div>

<div id="senior-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close" onclick="closePopup('senior-popup')">&times;</span>
        <img src="assets/images/senior.png" alt="Discount 2" style="width: 100%; height: auto;">
        <h2>Senior Citizens - 20% Discount</h2>
        <p>To avail of the 20% discount, please present your Senior Citizen ID, passport, or any other valid document that proves you are at least sixty (60) years old. This discount applies to both local and foreign senior citizens.</p>
    </div>
</div>

<div id="pwd-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close" onclick="closePopup('pwd-popup')">&times;</span>
        <img src="assets/images/pwd.jpg" alt="Discount 3" style="width: 100%; height: auto;">
        <h2>PWD (Person with Disability) - 20% Discount</h2>
        <p>To avail of the 20% discount, please present your PWD ID upon ticket purchase. Remember, no ID means no discount. This discount applies to both local and foreign PWDs. However, PWD ID is not required when the disability is apparent, such as when the passenger is an amputee.</p>
    </div>
</div>

<script>
function togglePopup(id) {
    document.getElementById(id).style.display = 'flex';
}

function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}
</script>

<?php include('includes/layout-footer.php')?>

<!-- CSS for popup styling -->
<style>
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 80%;
    max-width: 600px;
    max-height: 80%;
    overflow-y: auto;
    position: relative;
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}
</style>
