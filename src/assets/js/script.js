const transformContato = (event) => {
  let input = event.target;
  input.value = telefoneMascara(input.value);
};

const telefoneMascara = (value) => {
  if (!value) return "";
  value = value.replace(/\D/g, "");

  if (value.length > 10) {
    value = value.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
  } else {
    value = value.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
  }
  return value;
};
