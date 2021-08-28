<?php
class Section {
	public function __construct()
	{
	}

  /**
   * Section Top
   *
   * @param [type] $content
   * @return void
   */
	function mainSectionTop($content){
    ?>

    <style>
        @media screen and (min-width: 1200px) {
        }

        @media screen and (max-width: 992px) {
        }

        @media screen and (max-width: 767px) {
        }
    </style>

		<div class="page-container">
      <?php
      if($content == "true"){
      ?>

      <div>
        hello world
      </div>

      <?php
      }
      ?>

		<?php
	}

	function mainSectionBottom(){
		?>

		</div>

		<?php
	}
}
