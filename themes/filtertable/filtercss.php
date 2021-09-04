<style>
  table {
    counter-reset: order;
  }

  tbody tr {
    counter-increment: order;
  }

  td.order>span:before {
    content: counter(order);
  }

  table tr th {
    margin: 0;
  }
</style>

<link rel="stylesheet" href="<?= asset('css/jquery.dataTables.min.css'); ?>">