import IMask from 'imask';

const init_result_time_field_mask = () => {
  document.addEventListener('DOMContentLoaded', (evt) => {
    const container = document.querySelector('.carbon_fields_container_result_data');
    if (container) {
      const element = container.querySelector('input[name="carbon_fields_compact_input[_crb_result_time]"]');
      IMask(element, {
        mask: '`00:00:00{.00}',
        lazy: true,
        placeholderChar: ' '
      });
    }
  });
};

const init_imask = () => {
  init_result_time_field_mask();
};

export default init_imask;
