<template>
  <div class="container my-5">
    <table class="table table-bordered">
      <thead class="thead-light">
      <tr>
        <th>Course</th>
        <th>Date</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Invoice</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>Course Name</td>
        <td>11/03/2022 09:26</td>
        <td>Bkash</td>
        <td>118.25$</td>
        <td>Pending</td>
        <td class="text-center">
          <button class="btn view-btn btn-sm">Download<i class="fas fa-download ml-1"></i></button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    name: "purchasesJournalComponent",
  };
</script>

<style scoped>
  .badge-submitted {
    background-color: #dfe3ea;
    color: #2f4050;
    border-radius: 12px;
    padding: 5px 10px;
  }
  .badge-invoiced {
    background-color: #5bc0de;
    color: white;
    border-radius: 12px;
    padding: 5px 10px;
  }
  .reorder-btn {
    background-color: #5cb85c;
    color: white;
    border-radius: 8px;
  }
  .view-btn {
    background-color: #f5f5f5;
    color: #333;
    border-radius: 8px;
  }
  table td, th {
    vertical-align: middle !important;
  }
</style>
