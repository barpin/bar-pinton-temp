function binarydecompose(value) {
  var b = 1n;
  value=BigInt(value);
  var pows = [];
  while (b <= value) {
      if (b & value) pows.push(Number(b));
      b <<= 1n;
  }
  return pows;
}