<? require_once ('../../includes/layouts/header.php'); ?>




<script src="js/settings_page.js"></script>



        <div class="row col-md-12">
            <div class="row col-md-12">
                <ul class="nav nav-tabs" id="settings_navigation">
                    <li role="presentation" class="active">
                        <a id="users_button"  class="settings_menu_item" data-settingsmenu="user" style="cursor: pointer;">Users</a>
                    </li>
                    <li role="presentation">
                        <a id="country_button" class="settings_menu_item" data-settingsmenu="countries" style="cursor: pointer;">Countries</a>
                    </li>
                    <li role="presentation">
                        <a id="languages_button" class="settings_menu_item" data-settingsmenu="languages" style="cursor: pointer;">Languages</a>
                    </li>
                    <li role="presentation">
                        <a id="subjects_button" class="settings_menu_item" data-settingsmenu="subjects" style="cursor: pointer;">Subject</a>
                    </li>
                </ul>
            </div>
        </div>





        <!-- Include de modules -->
        <? require_once ('modules/user.php') ?>
        <? require_once ('modules/language.php') ?>
        <? require_once ('modules/subject.php') ?>
        <? require_once ('modules/country.php') ?>









