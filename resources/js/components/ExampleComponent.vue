<template>
  <div class="container">
    <div class="row">
      <div class="col-3 text-center" v-for="(item, index) in menu" :key="index">
        <img :src="item.img" alt="" class="imgmain"/>
        <div class="name">
          <p class="pri_name">{{ item.name }}</p>
          <p class="pri_name">{{ item.price }}</p>
        </div>
        <div class="count">
          <button @click="countli(-1, index)" class="plusbutton">
            <i class="bi bi-dash-square"></i>
          </button>

          <input type="number" v-model="menu[index].countlist" />
          <button @click="countli(1, index)" class="plusbutton">
            <i class="bi bi-plus-square"></i>
          </button>
        </div>

        <button class="btn btn-success add" @click="addon(index)">เพิ่ม</button>
      </div>
    </div>
    <div v-show="!visible" @click="showorder()" class="orderlist">
      <h1 class="iconorder"><i class="bi bi-clipboard-plus"></i></h1>
    </div>
    <order v-show="visible" :listorder="listorder" @setvisible="setvisible">
    </order>
    <div class="selme col-2.5">
         <selectmenu></selectmenu>
    </div>
   
  </div>
</template>

<script>
export default {
  mounted() {
    this.getstore();
  },
  methods: {
    getstore() {
      axios.get("api/stroefood").then((response) => {
        this.menu = response.data;
        this.menu.map((element) => {
          element.countlist = 0;
        });
        console.log(this.menu);
      });
    },
    countli(num, key) {
      const newmenu = this.menu[key];
      newmenu.countlist += num;
      if (newmenu.countlist < 0) {
        newmenu.countlist = 0;
      }
      this.$set(this.menu, key, newmenu);
      console.log(newmenu);
    },

    addon(index) {
      this.visible = true;
      console.log("click");
      if (this.menu[index].countlist > 0) {
        this.listorder.push({
          name: this.menu[index].name,
          count: this.menu[index].countlist,
          price: this.menu[index].price,
          allprice: this.menu[index].countlist * this.menu[index].price,
        });
      }

      console.log(this.listorder);
    },
    showorder() {
      this.visible = true;
    },
    setvisible(set) {
      this.visible = set;
    },
  },
  computed: {
    getcount(index) {
      return;
    },
  },
  data() {
    return {
      menu: [],
      menu: {
        countlist: {},
      },
      visible: false,
      number: 0,
      listorder: [],
    };
  },
};
</script>

<style scope>
* {
  margin: 0;
  padding: 0;
}
img {
   margin-top: 10px;
  width: 100%;
  height: 150px;
}
input {
  text-align: center;
  width: 30%;
  background-color: rgb(223, 211, 223);
}

.col-3,.c {
  border: solid 1px;
  margin: 10px;
  justify-content: center;
  background: cornsilk;
  border-radius: 5px;

}
.col-3:hover{
    cursor: pointer;
    
    
    
}
.name {
  text-align: center;
  display: flex;
  justify-content: space-between;
}
.count {
  width: 100%;
  display: flex;
  justify-content: center;
}
button {
}
.selme{
    padding: 10px;

  position: fixed;
  top: 20px;
  border-radius: 20px;
  right: 20px;
}
.orderlist {
  padding: 10px;

  position: fixed;
  bottom: 20px;
  border-radius: 20px;
  right: 20px;
}
.orderlist h1 {
  font-size: 50px;
}
.orderlist:hover {
  box-shadow: 10px 5px 10px rgba(0, 0, 0, 0.5);
  margin-bottom: 5px;
  cursor: pointer;
}
i {
  width: 80%;
}
.plusbutton {
  margin: 0px;
  padding: 0px;
  background: none;
  margin-bottom: 5px;
  padding: 5px;
}

.add {
    margin-top: 10px;
    margin-bottom:10px;
}
.bi{
    
}
.iconorder:hover{
    font-size: 80px;
    transition:1s;
}
.pri_name{
font-size: 20px;
}
</style>
