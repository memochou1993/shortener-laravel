<template>
    <div class="container">
        {{ msg }}
    </div>
</template>

<script>
export default {
  mounted() {
    props: ["link-data"], console.log("Component mounted.");
  },
  data: function() {
    return {
      msg: "Hello"
    };
  }
};
</script>
