<template>
  <div>
    <div class="container mt-5">
      <h2 class="mb-4 text-center">Course Purchase History</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Course Title</th>
            <th>Date Purchased</th>
            <th>Delivery Date</th>
            <th>Total Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Last Update</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>Introduction to Programming</td>
            <td>11/03/2022 09:26</td>
            <td>11/18/2022</td>
            <td>$210.50</td>
            <td>1</td>
            <td><span class="badge badge-info">COMPLETED</span></td>
            <td>12/13/2022 07:16</td>
            <td>
              <button class="btn btn-success btn-custom"><i class="fas fa-eye"></i> </button>
              <button class="btn btn-danger btn-custom"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Advanced JavaScript</td>
            <td>11/01/2022 12:51</td>
            <td>12/10/2022</td>
            <td>$65.00</td>
            <td>1</td>
            <td><span class="badge badge-warning">IN PROGRESS</span></td>
            <td>11/02/2022 07:33</td>
            <td>
              <button class="btn btn-success btn-custom"><i class="fas fa-eye"></i> </button>
              <button class="btn btn-danger btn-custom"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Web Development Bootcamp</td>
            <td>11/03/2022 12:40</td>
            <td>12/07/2022</td>
            <td>$65.00</td>
            <td>1</td>
            <td><span class="badge badge-info">COMPLETED</span></td>
            <td>12/12/2022 07:09</td>
            <td>
              <button class="btn btn-success"><i class="fas fa-eye"></i> </button>
              <button class="btn btn-danger btn-custom"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "purchasesJournalComponent",
  };
</script>

<style scoped>

</style>
