<!DOCTYPE html>
<html>

<head>
  <title>CSV Import</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous" />
  <style>
    html,
    body {
      display: flex;
      justify-content: center;
      height: 100%;
    }

    body,
    div,
    form,
    input {
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #222;
    }

    .container {
      padding: 10px 0;
      margin: auto;
    }

    table {
      border-collapse: collapse;
    }

    table,
    th,
    td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }

    .main-block {
      max-width: 360px;
      border-radius: 5px;
      border: solid 1px #ccc;
      box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.31);
      background: #ebebeb;
    }

    form {
      margin: 30px;
    }

    p {
      border-radius: 5px;
      padding: 5px;
      margin: 5px 0;
      background-color: #3cb14b;
    }

    p.error {
      color: #fff;
      background-color: #e82525;
    }

    p.uploading {
      margin: 30px;
      background-color: #dcdcdc;
    }

    .btn-block {
      margin-top: 10px;
      text-align: center;
    }

    button,
    a {
      width: 100%;
      padding: 10px;
      margin: 10px auto;
      border-radius: 5px;
      border: none;
      background: #1c87c9;
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      text-decoration: none;
    }

    button:hover,
    a:hover {
      background: #26a9e0;
    }

    a {
      width: auto;
      display: block;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">

    <?php if (!empty($customers)) { ?>

      <table>
        <thead>
          <tr>
            <th>Customer Id</th>
            <th>Number of calls (same continent)</th>
            <th>Total duration (same continent)</th>
            <th>Number of calls (all)</th>
            <th>Total duration (all)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($customers as $customerId => $customer) { ?>
            <tr>
              <td><?php print $customerId; ?></td>
              <td><?php print $customer["same"]["number"]; ?></td>
              <td><?php print $customer["same"]["duration"]; ?> seconds</td>
              <td><?php print $customer["all"]["number"]; ?></td>
              <td><?php print $customer["all"]["duration"]; ?> seconds</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <a href="/">Go Back</a>

    <?php } else { ?>

      <?php
      if (!empty($messages)) {
        foreach ($messages as $message) {
          print "<p class=\"error\">" . $message . "</p>";
        }
      }
      ?>

      <div class="main-block">
        <form name="csv" action="upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file" id="file" placeholder="File" />
          <div class="btn-block">
            <button type="submit" onclick="handleOnSubmit()">Submit</button>
          </div>
        </form>
      </div>

      <script type="text/javascript">
        function handleOnSubmit() {
          document.querySelectorAll('p.error').forEach(function(pele) {
            pele.remove();
          });
          document.forms["csv"].style.display = "none";
          const pele = document.createElement("p");
          pele.className = "uploading";
          pele.appendChild(
            document.createTextNode("Please wait until the file finish uploading and processing...")
          );
          document.forms['csv'].parentElement.appendChild(pele);
        }
      </script>

    <?php } ?>

  </div>
</body>

</html>