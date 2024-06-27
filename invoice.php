<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <title>PBL 1445 Tanda Terima Shodaqoh</title>

    <style>
      body {
        margin-top: 2mm;
        margin-bottom: 2mm;
        margin-right: 5mm;
        margin-left: 5mm;
      }

      .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 10px;
        /* border: 1px solid #eee;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
        font-size: 11px;
        line-height: 10px;
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }

      .invoice-box table td {
        padding: 2px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 10px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 0px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 300px) {
        .invoice-box table tr.top table td {
          width: 50%;
          /* display: block; */
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }

      /** RTL **/
      .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
          sans-serif;
      }

      .invoice-box.rtl table {
        text-align: right;
      }

      .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
      }
    </style>
  </head>

  <body onload="window.print()">
    <!-- Kodetrx -->
    <?php
    // Mendapatkan nilai kodetrx dari parameter URL
    $kodetrx = isset($_GET['kodetrx']) ? $_GET['kodetrx'] : '';
    $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
    ?>

    <div class="invoice-box">
      <table cellpadding="0" cellspacing="0">
        <tr class="top">
          <td colspan="4">
            <table>
              <tr>
                <td class="title" colspan="3">
                  <img src="img/logo pbl 1446 oyee.png" alt="" style="width: 50px; height: 50px" />
                </td>
                <td style="
                    text-align: center;
                    font-weight: bold;
                    font-size: 25px;
                    padding: 15px;
                  ">
                  <?php
                  $query = mysqli_query($conn, "SELECT kode_kartu FROM input WHERE kodetrx='$kodetrx'");
                  if ($row = mysqli_fetch_assoc($query)) {
                    echo $row['kode_kartu'];
                  } else {
                    echo '(kode kartu tidak ditemukan)';
                  }
                  ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="information" style="margin-top: 0px; padding-top: 0px">
          <td colspan="4">
            <table>
              <tr>
                <td style="
                    text-align: center;
                    text-decoration-line: underline;
                    font-weight: bold;
                    font-size: 15px;
                    padding-bottom: 5px;
                  ">
                  TANDA TERIMA SUMBANGAN
                </td>
              </tr>
              <tr>
                <td style="text-align: center; font-size: 13px">
                  ID Refrensi :
                  <?php
                  if ($row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kodetrx FROM input WHERE kodetrx='$kodetrx'"))) {
                    echo $row['kodetrx'];
                  }
                  ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td colspan="4">
            <table>
              <tr>
                <td style="margin-bottom: 5px; padding-bottom: 5px">
                  Nama &emsp; :
                  <?php
                  $query = mysqli_query($conn, "SELECT gelar1, gelar2, nama FROM input WHERE kodetrx='$kodetrx'");
                  if ($row = mysqli_fetch_assoc($query)) {
                    echo $row['gelar1'] . " " . $row['nama'] . " " . $row['gelar2'];
                  } else {
                    echo "-";
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td style="margin-top: 0px; padding-top: 0px">
                  Alamat &ensp; :
                  <?php
                  $query = mysqli_query($conn, "SELECT alamat FROM input WHERE kodetrx='$kodetrx'");
                  if ($row = mysqli_fetch_assoc($query)) {
                    echo $row['alamat'];
                  } else {
                    echo "-";
                  }
                  ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tbody id="table-body">
          <tr>
            <td colspan="4">
              <hr size="x" />
            </td>
          </tr>

          <tr class="heading" style="text-align: center">
            <td style="text-align: left">Berupa</td>
            <td style="text-align: left">Jumlah</td>
            <td colspan="2" style="text-align: left">Keterangan</td>
          </tr>

          <!-- --------------------------------------------- -->
          <?php
          $query = mysqli_query($conn, "SELECT * FROM input_detail WHERE kodetrx='$kodetrx'");
          while ($row = mysqli_fetch_assoc($query)) {
          ?>
            <tr style="text-align: left;">
              <td style="text-align: left"><?= $row['nama_barang']; ?></td>
              <?php if ($row['nama_barang'] == "Uang") { ?>
                <td style="text-align: left"><?= number_format($row['total_nominal'], 0, ',', '.'); ?></td>
              <?php } else { ?>
                <td style="text-align: left"><?= $row['total_jumlah']; ?></td>
              <?php } ?>
              <td colspan="2" style="text-align: left"><?= $row['keterangan']; ?></td>
            </tr>
          <?php
          }
          ?>
          <!-- --------------------------------------------- -->
        </tbody>

        <tr>
          <td><br></td>
        </tr>

        <tr>
          <td colspan="4">
            <table>
              <tr>
                <td colspan="2">
                  <i>Keterangan :</i>
                </td>
                <td colspan="2" style="text-align: center">
                  Kudus,
                  <?php
                  $query = mysqli_query($conn, "SELECT tanggal FROM input WHERE kodetrx='$kodetrx'");
                  if ($row = mysqli_fetch_assoc($query)) {
                    echo $row['tanggal'];
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="margin: 0; padding: 0">
                  <i>Tanda Terima ini tidak berlaku</i>
                </td>
                <td colspan="2" style="margin: 0; padding: 0; text-align: center"></td>
              </tr>
              <tr>
                <td colspan="2" style="margin: 0; padding: 0">
                  <i>untuk pengambilan brekat.</i>
                </td>
              </tr>

              <tr>
                <td colspan="4"></td>
              </tr>

              <tr>
                <td colspan="2">
                  <?php
                  $query = mysqli_query($conn, "SELECT created_at FROM input WHERE kodetrx='$kodetrx'");
                  if ($row = mysqli_fetch_assoc($query)) {
                    echo $row['created_at'];
                  }
                  ?>
                </td>
                <td colspan="2" style="margin: 0; padding: 0; text-align: center">
                  <?php
                  $query = mysqli_query($conn, "SELECT operator FROM input WHERE kodetrx='$kodetrx'");
                  if ($row = mysqli_fetch_assoc($query)) {
                    echo $row['operator'];
                  }
                  ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </body>

  </html>

<?php
} else {
  header("Location: index.php");
}
?>