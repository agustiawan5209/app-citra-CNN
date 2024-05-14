<template>
    <div>
      <h1>Sistem Pendukung Keputusan dengan CNN</h1>
      <button @click="trainModel">Latih Model</button>
      <button @click="makePrediction">Buat Prediksi</button>
      <p v-if="prediction">Prediksi: {{ prediction }}</p>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import * as tf from '@tensorflow/tfjs';

  const dataPreprocessor = ref(new DataPreprocessing());
  const modelCNN = ref(new ModelCNN());

  const trainModel = async () => {
    const data = await dataPreprocessor.value.load_data();
    const preprocessedData = dataPreprocessor.value.preprocess_data(data);
    const trainData = preprocessedData.trainData;
    const trainLabels = preprocessedData.trainLabels;

    modelCNN.value.build_model();
    await modelCNN.value.train_model(trainData, trainLabels);
  };

  const makePrediction = async () => {
    const data = await dataPreprocessor.value.load_data();
    const preprocessedData = dataPreprocessor.value.preprocess_data(data);
    const testData = preprocessedData.testData;

    const prediction = await modelCNN.value.make_prediction(testData);
    prediction.print(); // Cetak prediksi ke konsol
  };
  </script>
