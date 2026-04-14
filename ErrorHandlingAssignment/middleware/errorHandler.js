const { logEvents } = require("./logger");

const errorHandler = (err, req, res, next) => {
  const statusCode = res.statusCode >= 400 ? res.statusCode : 500;
  const errorName = err.name || "Error";
  const errorMessage = err.message || "Something went wrong";

  logEvents(
    `${errorName}: ${errorMessage}\t${req.method}\t${req.originalUrl}`,
    "errorLog.txt",
  );

  console.error(`${errorName}: ${errorMessage}`);

  res.status(statusCode).json({
    message: "Internal Server Error",
  });
};

module.exports = errorHandler;