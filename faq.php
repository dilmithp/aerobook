<?php include_once 'header.php'; ?>

<div class="faq-container">
  <h1>Frequently Asked Questions</h1>

  <div class="faq-item">
    <h3>1. How can I book a flight?</h3>
    <p>You can book a flight by visiting our booking page, selecting your destination, and following the on-screen instructions.</p>
  </div>

  <div class="faq-item">
    <h3>2. What is the cancellation policy?</h3>
    <p>Cancellations can be made up to 24 hours before the scheduled departure. Fees may apply depending on the fare type.</p>
  </div>

  <div class="faq-item">
    <h3>3. How do I check my flight status?</h3>
    <p>Flight status can be checked by visiting our 'Flight Status' page and entering your flight number.</p>
  </div>

  <div class="faq-item">
    <h3>4. Can I change my flight after booking?</h3>
    <p>Yes, you can make changes to your booking through the 'Manage My Booking' section on our website. Additional fees may apply.</p>
  </div>
</div>

<script>
  const faqItems = document.querySelectorAll('.faq-item h3');

  faqItems.forEach(item => {
    item.addEventListener('click', () => {
      const faq = item.parentNode;
      faq.classList.toggle('active');
    });
  });
</script>

<?php include_once 'footer.php'; ?>