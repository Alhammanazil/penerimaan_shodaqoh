<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>PBL 1445 No Hewan</title>

		<style>
      body
        {
          margin-top: 5mm;
          margin-bottom: 5mm;
          margin-right: 5mm;
          margin-left: 5mm;
        }
		</style>


	</head>
    
	<body onload="window.print()">
		<div style="margin-right: 400px; text-align: center; vertical-align: center;">
      <?php
      include "db_conn.php";
        // Mendapatkan nilai kodetrx dan kodetrx_detail dari parameter URL
        $kodetrx = isset($_GET['kodetrx']) ? $_GET['kodetrx'] : '';
        $kodetrx_detail = isset($_GET['kodetrx_detail']) ? $_GET['kodetrx_detail'] : '';
        $row = $conn->query("SELECT urut_hewan, atas_nama FROM input_detail WHERE kodetrx_detail = '$kodetrx_detail' ORDER BY urut_hewan ASC LIMIT 1")->fetch_assoc();
        $no_urut = $row['urut_hewan'];
        $atas_nama = $row['atas_nama'];
      ?>
      <h1 style="font-size: 200px; padding: 0px; margin: 0px;"><?= $no_urut; ?></h1>
      <h1><?= $atas_nama; ?></h1>
      <p>
		</div>

	</body>
</html>

