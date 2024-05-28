
var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost/Kerim123/gym-backend/";
    } else {
      return "https://lionfish-app-d4v7d.ondigitalocean.app";
    }
  },
};