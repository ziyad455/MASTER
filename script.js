function greet(name) {
  console.log("Hello, " + name + "!");
}

console.log("Hello, world!");
greet("Osaka");

try {
  throw new Error("An error occurred!");
} catch (error) {
  console.error("An error occurred:", error.message);
}