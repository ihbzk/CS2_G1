import { default as index } from './views/Index.js';
import { default as stepTwo } from './views/StepTwo.js';
import { default as notFound } from './views/NotFound.js';

export default {
  "/install/step-1": index,
  "/install/step-2": stepTwo,
  "/404": notFound
};
