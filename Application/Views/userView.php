<h1>Users</h1>
<p>
  <?php
      if (isset($data['error'])) {
          echo $data['error'];
      } else {
          foreach($data as $row)
          {
            echo join(' ', [$row['first_name'], $row['last_name'], $row['age']]) . '<br/>';
          }
      }
  ?>
</p>