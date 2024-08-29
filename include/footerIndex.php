<footer class="text-center bg-light border-top">
    <div class="container p-4">
        <!-- Carte centrée -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="text-uppercase font-weight-bold">Nous trouver</h5>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2648.6487966995714!2d-71.24606314627651!3d48.405687310481845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc028debdcd9433%3A0x300905780fc47bd7!2sPavillon%20Joseph-Angers!5e0!3m2!1sfr!2sca!4v1715808164679!5m2!1sfr!2sca"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- Autres informations -->
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase font-weight-bold">Contact</h5>
                <ul class="list-unstyled">
                    <a href="#" class="link-dark" data-bs-toggle="modal"
                        data-bs-target="#contactModal">Contactez-nous</a>
                    <li><a href="faq.php" class="link-dark">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase font-weight-bold">À propos</h5>
                <ul class="list-unstyled">
                    <li><a href="#!" class="link-dark">Mentions légales</a></li>
                    <li><a href="#!" class="link-dark">Politique de confidentialité</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center py-2" style="background-color: rgba(0,0,0,0.05);">
        <div class="social-links">
            <a href="https://twitter.com/" class="me-2"><i class="bi bi-twitter"></i></a>
            <a href="https://facebook.com/" class="me-2"><i class="bi bi-facebook"></i></a>
            <a href="https://instagram.com/" class="me-2"><i class="bi bi-instagram"></i></a>
            <a href="https://linkedin.com/" class="me-2"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>
    <div class="text-center py-1" style="background-color: rgba(0,0,0,0.05);">
        © 2024 AkiProject.com
    </div>
</footer>
<!-- Modal Contact -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contactez-nous</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
