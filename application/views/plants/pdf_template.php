<html>
<head>
    <style>
        /* Style for the table */
        table {
           width: 100%;
           border-collapse: collapse; /* Ensure borders are merged */
           margin-top: 10px;
        }

        th, td {
           border: 1px solid #000; /* Add border to table cells */
        }
        td{
            font-size: 12px;
            padding-left: 5px;
        }

        th {
           background-color: #f2f2f2; /* Light gray background for header */
        }

        tr:nth-child(even) {
           background-color: #f9f9f9; /* Alternating row color */
        }

    </style>
</head>
<body>
    <?php 
        foreach ($all_division_details_array as $div_key => $plant_details) {
    ?>
        <table class="table">
          <thead>
            <tr>
              <th class="text-center" colspan="17"><?php echo $div_key; ?></th>
            </tr>
            <tr>
                <th class="text-center" rowspan="3"></th>
                <?php for ($i=0; $i < count($year_array); $i++) { ?>
                    <th class="text-center" colspan="8"><?php echo $year_array[$i]; ?></th>
                <?php } ?>
            </tr>
            <tr>
                <?php for ($i=0; $i < count($year_array); $i++) {
                    for ($j=0; $j < count($quater); $j++) { ?>
                        <th class="text-center" colspan="2"><?php echo $quater[$j]; ?></th>
                <?php } } ?>
            </tr>
            <tr>
                <?php for ($i=0; $i < count($year_array); $i++) {
                    for ($j=0; $j < count($quater); $j++) {
                        for ($p=0; $p < count($ap_array); $p++) { ?>
                        <th class="text-center"><?php echo $ap_array[$p]; ?></th>
                <?php } } } ?>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($plant_details as $category => $items): ?>
                  <?php $showCategory = true; ?>
                  <?php foreach ($items as $sub_category => $sub_cate_item): ?>
                      <?php if ($category !== $sub_category): ?>
                          <?php if ($showCategory): ?>
                              <tr>
                                  <td class="category_font"><b><?= $category ?></b></td>
                                  <td colspan="<?= count($sub_cate_item) ?>"></td>
                              </tr>
                              <?php $showCategory = false; ?>
                          <?php endif; ?>
                          <tr>
                              <td class="sub_category_font"><?= $sub_category ?></td>
                              <?php foreach ($sub_cate_item as $item): ?>
                                  <td>
                                      <?= $item['Value'] ?>
                                  </td>
                              <?php endforeach; ?>
                          </tr>
                      <?php else: ?>
                          <tr>
                              <td class="category_font"><b><?= $sub_category ?></b></td>
                              <?php foreach ($sub_cate_item as $item): ?>
                                  <td>
                                      <?= $item['Value'] ?>
                                  </td>
                              <?php endforeach; ?>
                          </tr>
                      <?php endif; ?>
                  <?php endforeach; unset($sub_cate_item); ?>
              <?php endforeach; unset($items); ?>
          </tbody>          
        </table>
    <?php
        }
    ?>
</body>
</html>
