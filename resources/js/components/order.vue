<template>
  <div class="card col-5">
      <header>
           <h4>รายการอาหาร</h4>
    <p @click="setvisible"><i class="bi bi-x-circle"></i></p> 
      </header>
  <div class="t">
      <table class="table table-striped">
      <tr>
          
        <th>เมนู</th>
        <th>จำนวน</th>
        <th>ราคา(ชิ้น)</th>
        <th>ราคารวม</th>
      </tr>
      <tr v-for="(item, index) in listorder" :key="index">
        <td>{{ item.name }}</td>
        <td>{{ item.count }}</td>
        <td>{{ item.price }}</td>
        <td>{{ item.allprice }}</td>
      </tr>
    </table>
  </div>
  <div class="bottomdetail" >
      <p class="sumtotal">ยอดรวม:{{totalmoney}}</p>
      <button class="btn btn-danger" @click="sale()">สั่งซื้อ</button>
  </div>
    
  </div>
</template>

<script>
export default {
  props: {
    listorder: {},
  },
  methods:{
      setvisible(){
          this.$emit("setvisible",false);
      },
      sale(){
          axios.post('api/stroefood',this.listorder
          ).then(response=>{
          if(response.data==true){
              alert("ทำการสั่งซื้อสำเร็จ")
          }
          });
      }
  },
  data(){
  return {
    total:0,
  };
  },
  computed:{
      totalmoney(){
        var count = 0;
         this.listorder.map((item)=>{
             
             count += item.allprice;
         });
        this.total = count;
         return this.total;
      }
  }
};
</script>

<style scoped>
*{
    margin: 0px;
    padding: 0px;
      
}
.card {
    
    padding: 10px;
  background: rgba(230, 224, 224,0.9);
  position: fixed;
  bottom: 20px;
  height: 30%;
  right: 20px;
  
  box-shadow: 5px 4px 5px rgba(0, 0, 0, 0.4);
}
table{
    margin-left: 5%;
}
.t{
    overflow-y: scroll;
    width: 100%;
    background-color: white;
    
}
header{
    padding: 0px;
    margin: 0px;
    display: flex;
    justify-content:space-between ;
}
header p{
    padding: 0px;
    font-size: 30px;
    margin-top:-5px ;
}
header p:hover{
cursor: pointer;
color: red;
}
.bottomdetail{
  background: aliceblue;
text-align: center;
}
.sumtotal{
  font-size: 15px;
}
</style>