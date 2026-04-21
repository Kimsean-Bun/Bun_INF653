require('dotenv').config();
const express = require('express');
const connectDB = require('./dbConfig');
const studentRoutes = require('./routes/studentRoutes');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware — parse incoming JSON bodies
app.use(express.json());

// Routes
app.use('/students', studentRoutes);

// Root health-check route
app.get('/', (req, res) => {
  res.json({ message: 'Student Records API is running' });
});

// 404 handler for unknown routes
app.use((req, res) => {
  res.status(404).json({ success: false, message: 'Route not found' });
});

// Connect to MongoDB, then start the server
connectDB().then(() => {
  app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
  });
});
