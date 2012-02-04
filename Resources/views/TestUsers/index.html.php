<?php $view->extend('AizattoFacebookBundle:TestUsers:base.html.php'); ?>

<h1>Facebook Test Users (<?php echo count($users); ?>)</h1>
<p>Last Fetched: <?php echo date(DATE_RFC1036, $created_at); ?></p>
<p>Remember to <strong>login from a new browser</strong>.</p>
<p>Else you will be logged out of your Facebook session.</p>
<p>
  These Login URLs only exist for 10 minutes at a time, and can only be used once.
</p>
<?php foreach ($users as $id => $user): ?>
  <?php if (isset($user['name'])): ?>
    <h2><?php echo $user['name']; ?> (<em><?php echo $id; ?></em>)</h2>
  <?php else: ?>
    <h2><?php echo $id; ?></h2>
  <?php endif; ?>
  <table class="zebra-striped">
    <tbody>
      <tr>
        <td style="width: 100px">id</td>
        <td><?php echo $id; ?></td>
      </tr>
      <?php if (isset($user['name'])): ?>
        <tr>
          <td>name</td>
          <td><?php echo $user['name']; ?></td>
        </tr>
      <?php endif; ?>
      <tr>
        <td>login url</td>
        <td>
          <input type="text" value="<?php echo $user['login_url']; ?>" style="width: 80%" />
          <a href="<?php echo $user['login_url']; ?>">Switch to user</a>
        </td>
      </tr>
      <?php if (isset($user['access_token'])): ?>
        <tr>
          <td>name</td>
          <td>
            <input type="text" value="<?php echo $user['access_token']; ?>" style="width: 80%" />
          </td>
        </tr>
      <?php endif; ?>
      <tr>
        <td>keys</td>
        <td>
          <?php echo implode(', ', array_keys($user)); ?>
        </td>
      </tr>
    </tbody>
  </table>
<?php endforeach; ?>
