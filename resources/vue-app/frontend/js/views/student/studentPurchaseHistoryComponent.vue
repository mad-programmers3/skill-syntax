<template>
  <div>
    <h1 class="border-top10px"> Your Purchases History</h1>
    <table>
      <thead>
      <tr>
        <th colspan="5" class="header-row">Purchases Course</th>
      </tr>
      <tr>
        <th>#Order</th>
        <th>Date</th>
        <th>Price</th>
        <th>Payment Type</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>Oct 1</td>
        <td>30/10/24</td>
        <td>8000</td>
        <td>Bkash</td>
        <td>delete</td>
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
  /* Table General Style */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: center;
  }

  thead th {
    background-color: #e0f0f7;
    font-weight: bold;
    font-size: 16px;
  }

  .header-row {
    text-align: left;
    font-weight: bold;
  }

  /* Table Row Design */
  tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tbody tr:hover {
    background-color: #f1f1f1;
  }

  .total-row {
    background-color: #e9f5e9;
    font-weight: bold;
  }

  /* Header Design */
  h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 20px;
  }
</style>
