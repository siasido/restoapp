<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="style.css">
      <title>Receipt example</title>
      <style>@page { size: 80mm auto }</style>
      <link rel="stylesheet" href="<?=base_url().'assets/css/receipt.css'?>">
   </head>
   <body>
      <div id="invoice-POS">
         <div id="mid">
            <div class="info">
               <h2 style="text-align: center;">Receipt</h2>
               <?php $orderdate = DateTime::createFromFormat('Y-m-d H:i:s', $row->orderdate); ?>
               <p> 
                    OrderDate: <?=$orderdate->format('d/m/Y - H:i')?></br>
                    No. Bill  : <?=$row->nomorbill?></br>
                    Customer  : <?=$row->nama?></br>
                    No. Meja : <?=$row->nomorMeja?></br>
                    No. HP   : <?=$row->noHP?>  </br>
               </p>
            </div>
         </div>
         <!--End Invoice Mid-->
         <div id="bot">
            <div id="table">
               <table>
                  <tr class="tabletitle">
                     <td class="item"><h2>Item</h2></td>
                     <td class="Hours"><h2>Qty</h2></td>
                     <td class="Rate"><h2>Amount</h2></td>
                  </tr>
                  <?php foreach ($selected_items as $key => $res) { ?>
                  <tr class="service">
                     <td class="tableitem"><p class="itemtext"><?=$res->namaMenu?></p></td>
                     <td class="tableitem"><p class="itemtext"><?=$res->qty?></p></td>
                     <td class="tableitem"><p class="itemtext"><?=number_format($res->amount,2,',','.') ?></p></td>
                  </tr>

                  <?php } ?>
                  
                  <tr class="tabletitle">
                     <td></td>
                     <td class="Rate">
                        <h2>Subtotal</h2>
                     </td>
                     <td class="payment">
                        <h2><?=number_format($row->gross_amount,2,',','.') ?></h2>
                     </td>
                  </tr>
                  <tr class="tabletitle">
                     <td></td>
                     <td class="Rate">
                        <h2>Tax</h2>
                     </td>
                     <td class="payment">
                        <h2><?=number_format($row->tax,2,',','.') ?></h2>
                     </td>
                  </tr>
                  <tr class="tabletitle">
                     <td></td>
                     <td class="Rate">
                        <h2>Total</h2>
                     </td>
                     <td class="payment">
                        <h2><?=number_format($row->net_amount,2,',','.') ?></h2>
                     </td>
                  </tr>
               </table>
            </div>
            <!--End Table-->
            <div id="legalcopy">
               <p class="legal" style="text-align: center;"><strong>Terimakasih, telah mengunjungi kami.</strong>  <br> Jangan lupa datang kembali ya! 
               </p>
            </div>
         </div>
         <!--End InvoiceBot-->
      </div>
      <!--End Invoice-->
      <script>

        window.addEventListener("load", window.print());
      </script>
   </body>
</html>