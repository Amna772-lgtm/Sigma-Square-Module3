<?php
/**
 * Public site functionality of plugin
 */

class Wp_Forms_Public
{
    private $version = '1.0.0';
    public function __construct()
    {
        //constructor code
    }


    //including css file
    public function enqueue_styles()
    {
        wp_enqueue_style('wp-forms-public', plugin_dir_url(__FILE__) . 'css/public.css', array(), $this->version, 'all');
    }


    //including js file
    public function enqueue_scripts()
    {
        wp_enqueue_script('wp-forms-public', plugin_dir_url(__FILE__) . 'js/public.js', array('jquery'), $this->version, false);

        //used to pass data from PHP to JavaScript files. 
        wp_localize_script(
            'wp-forms-public',
            'wpforms_vars',
            array(
                'ajax_url' => admin_url('admin-ajax.php'), //URL to handle ajex request
                'login_url' => site_url('/login'),
                'register_url' => site_url('/register'),
                'todo_list_url' => site_url('/todo-list')
            )
        );
    }

    //registration form
    public function registration_form()
    {

        //start output buffering, PHP will store all output in an internal buffer instead of sending it directly to the browser
        ob_start();

        ?>
        <div class="container">
            <div class="container__form-container" id="register-form">
                <h2 class="form-container__title">Register User</h2>
                <form method="POST" id="register">
                    <input type="hidden" name="action" value="register">
                    <div class="form-container__input-group">
                        <label for="register-name" class="input-group__label">Name</label>
                        <input type="text" class="input-group__input" id="name" name="name" placeholder="Enter your name"
                            required>
                        <span id="name-error" class="input-group__error-message"></span>
                    </div>
                    <div class="form-container__input-group">
                        <label for="register-email" class="input-group__label">Email</label>
                        <input type="email" class="input-group__input" id="email" name="email" placeholder="abc@gmail.com"
                            required>
                        <span id="email-error" class="input-group__error-message"></span>
                    </div>
                    <div class="form-container__input-group">
                        <label for="register-password" class="input-group__label">Password</label>
                        <input type="password" class="input-group__input" id="password" name="password"
                            placeholder="Enter your password" required>
                        <span id="password-error" class="input-group__error-message"></span>
                    </div>
                    <div class="form-container__input-group">
                        <label for="register-confpassword" class="input-group__label">Confirm Password</label>
                        <input type="password" class="input-group__input" id="confpassword" name="confpassword"
                            placeholder="Enter password again" required>
                        <span id="confpassword-error" class="input-group__error-message"></span>
                    </div>
                    <button type="submit" class="form-container__button">Register</button>
                    <p class="register-link">Already have an account? <a href="<?php echo site_url('/login'); ?>"
                            class="register-link__a">Login</a></p>
                </form>
            </div>
        </div>

        <?php
        //return the buffer contents and clears the buffer.
        return ob_get_clean();
    }


    //handle registration form submission
    public function handle_registration()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'register') {
            global $wpdb;
            $table_name = $wpdb->prefix . 'register_users';

            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_email($_POST['email']);
            $password = $_POST['password'];
            $confpassword = $_POST['confpassword'];

            $errors = array();

            // Input validation
            if (empty($name)) {
                $errors['name'] = "Name is required";
            }

            if (!is_email($email)) {
                $errors['email'] = "Please enter a valid email";
            }

            if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}:;<>,.?~\\/-])[A-Za-z\d!@#$%^&*()_+{}:;<>,.?~\\/-]{8,}$/', $password)) {
                $errors['password'] = "Password must be at least 8 characters long and contain at least one capital letter, one special character, and one number.";
            }

            if ($password !== $confpassword) {
                $errors['confpassword'] = "Passwords do not match";
            }

            // Check if there are no validation errors
            if (empty($errors)) {
                // Check if the email already exists
                $existing_user = $wpdb->get_var($wpdb->prepare("SELECT email FROM $table_name WHERE email = %s", $email));
                if ($existing_user) {
                    // If the user already exists
                    $errors['email'] = "Email already exists";
                } else {
                    // Register the user
                    $wpdb->insert(
                        $table_name,
                        array(
                            'name' => $name,
                            'email' => $email,
                            'password' => wp_hash_password($password)
                        )
                    );

                    if ($wpdb->last_error) {
                        error_log("DB Error: " . $wpdb->last_error);
                        echo json_encode(array('success' => false, 'errors' => array('db' => 'Database error occurred.')));
                        wp_die();
                    }

                    // Successfully registered
                    echo json_encode(array('success' => true));
                    wp_die();
                }
            }

            // Return errors if validation failed or user exists
            echo json_encode(array('success' => false, 'errors' => $errors));
            wp_die();
        }
    }

    /**
     * Login form shortcode
     */
    public function login_form()
    {

        ob_start();

        ?>

        <div class="container">
            <div class="container__form-container" id="login-form">
                <h2 class="form-container__title">Login</h2>
                <form method="POST" id="login">
                    <input type="hidden" name="action" value="login">
                    <div class="form-container__input-group">
                        <label for="email" class="input-group__label">Email</label>
                        <input type="email" class="input-group__input" id="email" name="email" placeholder="abc@gmail.com"
                            required>
                        <span id="email-error" class="input-group__error-message"></span>
                    </div>
                    <div class="form-container__input-group">
                        <label for="password" class="input-group__label">Password</label>
                        <input type="password" class="input-group__input" id="login-password" name="password"
                            placeholder="Enter your password" required>
                        <span id="password-error" class="input-group__error-message"></span>
                    </div>
                    <button type="submit" class="form-container__button">Login</button>
                    <p class="register-link">Don't have an account? <a href="<?php echo site_url('/register'); ?>"
                            class="register-link__a">Register</a>
                    </p>
                </form>
            </div>
        </div>

        <?php
        return ob_get_clean();

    }

    /**
     * Function to handle login functionality
     */
    public function handle_login()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'login') {
            global $wpdb;
            $table_name = $wpdb->prefix . 'register_users';

            $email = sanitize_email($_POST['email']);
            $password = $_POST['password'];

            $errors = array();

            // Input validation
            if (!is_email($email)) {
                $errors['email'] = "Please enter a valid email";
            }

            // Validate password pattern
            if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}:;<>,.?~\\/-])[A-Za-z\d!@#$%^&*()_+{}:;<>,.?~\\/-]{8,}$/', $password)) {
                $errors['password'] = "Password must be at least 8 characters long and contain at least one capital letter, one special character, and one number.";
            }

            // Check if the email exists
            if (empty($errors)) {
                $user = $wpdb->get_row(
                    $wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email)
                );

                if (!$user) {
                    $errors['email'] = "User not registered";
                } elseif (!wp_check_password($password, $user->password)) {
                    $errors['password'] = "Incorrect password";
                }
            }

            // Return errors if validation failed or credentials are incorrect
            if (!empty($errors)) {
                echo json_encode(array('success' => false, 'errors' => $errors));
            } else {
                // Respond with success
                echo json_encode(array('success' => true));
            }
            wp_die(); //used to terminate script execution
        }
    }

}





