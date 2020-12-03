<form id="cuvitaContactForm" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <div>
        <label for="name"><?php _e( 'Your Name', 'cuvita' ) ?></label>
        <input type="text" placeholder="<?php _e( 'John Doe', 'cuvita' ) ?>" id="name" name="name" required="required">   
    </div>
    <div>
        <label for="email"><?php _e( 'Your E-mail', 'cuvita' ) ?></label>
        <input type="email" placeholder="<?php _e( 'johndoe@mail.com', 'cuvita' ) ?>" id="email" name="email" required="required">   
    </div>
    <div>
        <label for="message"><?php _e( 'Your Message', 'cuvita' ) ?></label>
        <textarea name="message" id="message" cols="30" rows="10 required="required" ></textarea>
    </div>

    <button type="submit"><?php _e( 'Submit', 'cuvita' ) ?></button>
    <div class="response">
        
    </div>
</form>