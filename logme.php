<?php
/*
 *  Copyright (C) 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
?>

<div style="padding-top: 5%;"  class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <div class="text-center">
        <img class="img-fluid" src="img/favicon.png" alt="User profile picture">
      </div>
      <h3 style="margin: 30px;" class="text-center">MIKHMON</h3>
      <form autocomplete="off" action="" method="post">
        <div class="form-group has-feedback">
          <input class="form-control form-control-sm" type="text" name="user" placeholder="User" required="1" autofocus>
        </div>
        <div class="form-group has-feedback">
          <input class="form-control form-control-sm" type="password" name="pass" placeholder="Password" required="1">
        </div>
        <div class="row">
          <div class="col-12">
		        <input class="btn btn-primary btn-block" type="submit" name="login" value="Login">
          </div>
        </div>

      </form>
    <div style="margin-top: 10px;" class="block">
    <?php echo $error; ?>
    </div>
    </div>
  </div>
</div>
</body>
</html>