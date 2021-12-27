<template>
  <div class="container">
    <h1 class="headadmin">Order ที่เหลือ</h1>
    <table class="table table-hover">
      <tr>
        <th>id_order</th>
        <th>ชื่อเมนู</th>
        <th>จำนวน</th>
        <th>ราคา(ชิ้น)</th>
        <th>ราคารวม(ชุด)</th>

        <th>วันที่</th>
        <th>ดำเนินการ</th>
      </tr>
      <tr v-for="(item, index) in getlist" :key="index">
        <td>
          {{ item.id }}
        </td>
        <td>
          <ul>
            <li v-for="(item2, index2) in item.order.split(',')" :key="index2">
              {{ item2 }}
            </li>
          </ul>
        </td>
        <td>
          <ul>
            <li v-for="(item2, index2) in item.count.split(',')" :key="index2">
              {{ item2 }}
            </li>
          </ul>
        </td>
        <td>
          <ul>
            <li v-for="(item2, index2) in item.price.split(',')" :key="index2">
              {{ item2 }}
            </li>
          </ul>
        </td>
        <td>
          <ul>
            <li
              v-for="(item2, index2) in item.allprice.split(',')"
              :key="index2"
            >
              {{ item2 }}
            </li>
          </ul>
        </td>
        <td>
          {{ item.created_at }}
        </td>
        <td>
          <button class="" @click="deletelist(item.id)">ดำเนินการสำเร็จ</button>
        </td>
      </tr>
    </table>
    <div class="control">
      <button class="clearall">ลบทั้งหมด</button>
      <h1 @click="reloadPage()" class="reload">
        <i class="bi bi-arrow-clockwise"></i>
      </h1>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getorder();
   // this.startInterval();
  },
  methods: {
    startInterval: function () {
      setInterval(function () {
       
        axios.get("api/order").then((response) => {
          console.log(this.listorder);
        }); 
      }, 1500);
    },
    getorder() {
      axios.get("api/order").then((response) => {
        this.listorder = response.data;
        console.log(this.listorder);
      });
    },
    deletelist(id) {
      axios.get("api/order/" + id + "/edit").then((response) => {
        console.log(response.data);
      });
      this.listorder = this.listorder.filter((item) => {
        return item.id !== id;
      });
    },
    reloadPage() {
      window.location.reload();
    },
  },
  data() {
    return {
      listorder: [],
      listorder2: [],
    };
  },
  computed: {
    getlist() {
      return this.listorder;
    },
  },
};
</script>

<style scoped>
button {
  background-color: rgb(47, 125, 76);
  color: rgb(250, 250, 250);
  border-radius: 10px;
}
.reload {
  cursor: pointer;
}
.reload:hover {
}
.control {
  display: flex;
  justify-content: center;
}
.clearall {
  margin-right: 10px;
  background-color: crimson;
}
.headadmin {
  text-align: center;
  margin-top: 20px;
}
</style>