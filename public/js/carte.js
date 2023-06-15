// bibliothèque Leaflet pour afficher une carte et ajouter des marqueurs avec des popups.

var map = L.map("map").setView([43.583328, 5.0], 14);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

L.marker([43.584562, 5.001801])
  .addTo(map)
  .bindPopup('Tri de cartons<br/><div id="tof-1"></div>')
  .openPopup();
L.marker([43.594302, 5.011278])
  .addTo(map)
  .bindPopup('Dépôt vêtements<br/><div id="tof-2"></div>')
  .openPopup();
L.marker([43.580319, 5.000831])
  .addTo(map)
  .bindPopup('Borne de charge<br/><div id="tof-3"></div>')
  .openPopup();
L.marker([43.574504, 5.001308])
  .addTo(map)
  .bindPopup('Dépôt vêtements<br/><div id="tof-4"></div>');
L.marker([43.576287, 4.9968])
  .addTo(map)
  .bindPopup('Point de tri<br/><div id="tof-5"></div>')
  .openPopup();
L.marker([43.589632, 5.004482])
  .addTo(map)
  .bindPopup('Point de tri<br/><div id="tof-6"></div>')
  .openPopup();
L.marker([43.597341, 5.006489])
  .addTo(map)
  .bindPopup('Point de tri<br/><div id="tof-7"></div>')
  .openPopup();
L.marker([43.595226, 4.991844])
  .addTo(map)
  .bindPopup('Borne de charge<br/><div id="tof-8"></div>')
  .openPopup();

