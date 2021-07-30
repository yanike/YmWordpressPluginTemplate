<?php
require_once 'Section.php';

class TestSection
{

    public function __construct()
    {
    }

    /**
     * AJAX Calls for TestSection
     */
    function ajaxCalls()
    {
        /**
         * WP AJAX for Test
         */
        function test_fun() {
          $terms = $_POST['post_item'];

          echo json_encode($terms, JSON_HEX_QUOT);
          die();
        }
        add_action('wp_ajax_test_fun', 'test_fun');
        add_action('wp_ajax_nopriv_test_fun', 'test_fun');
    }

    /**
     * Returns the content for TestSection
     *
     * @param mixed $atts
     */
    function getContent($atts, $plugin_dir)
    {
        ?>

        <style>
            @media screen and (min-width: 1200px) {
            }

            @media screen and (max-width: 992px) {
            }

            @media screen and (max-width: 767px) {
            }
        </style>

        <?php
        $sec = new Section();
        $sec->mainSectionTop("true");
        ?>

        <div class="test-section">
        </div>

        <?php
        $sec->mainSectionBottom();
        ?>

        <script>
          // AJAX for calling WP Admin AJAX to run server PHP code
          jQuery.ajax({
              method: "POST",
              url: "/wp-admin/admin-ajax.php",
              data: {
                  action: 'test_fun',
                  post_item: "item"
              }
          }).done(function (data) {
            console.log(data);
            let dataJson = JSON.parse(data);
          }).fail(function (jqXHR, textStatus) {
            console.log("Request failed: " + textStatus);
          });
        </script>

        <?php
    }
}
