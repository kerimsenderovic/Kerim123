
var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost/Kerim123/gym-backend/";
    } else {
      return "https://oyster-app-3s7wz.ondigitalocean.app/gym-backend/";
    }
  },
};