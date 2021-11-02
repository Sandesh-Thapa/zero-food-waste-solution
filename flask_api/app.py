# coding: utf8
import ast
import os
import re
import datetime
import json
import joblib
import logging
from logging.handlers import TimedRotatingFileHandler

from flask import Flask, render_template, request, session, redirect, Response, url_for
from bson import json_util
from bson.json_util import dumps
from decouple import config

import numpy as np
from tensorflow.keras.models import load_model

app = Flask('zero_waste_forecasting')
app.secret_key = config('SECRET_KEY')

if not app.debug:
    formatter = logging.Formatter("[%(asctime)s] - %(levelname)s - %(message)s")
    handler = TimedRotatingFileHandler('logs/flask_server.log', when="midnight", interval=1, encoding='utf8')
    handler.suffix = "%Y-%m-%d"
    handler.setFormatter(formatter)
    handler.setLevel(logging.INFO)
    app.logger.addHandler(handler)

requests_forecast_model = load_model('models/food_chain_requests.h5', compile = False)
donations_forecast_model = load_model('models/food_chain_donations.h5', compile = False)
labelencoder = joblib.load('models/label_encoder.pkl')


@app.route("/")
def index():
    return "<h1 style='color:blue'> Demand & Supply Forecasting API Homepage !</h1>"


@app.route('/requests/forecast/', methods=['POST'])
def forecast_upcoming_requests():
    today_data = request.form.get('today_data')
    yesterday_data = request.form.get('yesterday_data')
    past_2_days_data = request.form.get('past_2_days_data')
    past_3_days_data = request.form.get('past_3_days_data')

    if today_data is not None and yesterday_data is not None and past_2_days_data is not None and past_3_days_data is not None:
        try:
            past_data= []
            today_data = ast.literal_eval(today_data)
            yesterday_data = ast.literal_eval(yesterday_data)
            past_2_days_data = ast.literal_eval(past_2_days_data)
            past_3_days_data = ast.literal_eval(past_3_days_data)
            past_data.append(today_data)
            past_data.append(yesterday_data)
            past_data.append(past_2_days_data)
            past_data.append(past_3_days_data)
            array_input = []
            for index in past_data:
                ind_data = []
                for data in index:
                    ind_data.append(labelencoder.transform([data])[0])
                len_ind_data = len(ind_data)
                if len_ind_data < 18:
                    no_to_balance = 18 - len_ind_data
                    for _ in range(no_to_balance):
                        ind_data.append(0)
                elif len_ind_data > 18:
                    ind_data = ind_data[:18]
                array_input.append(ind_data)

            results = requests_forecast_model.predict(np.array(array_input).reshape(1, 4, 18))
            results_list = [int(round(i)) for i in list(results)[0]]
            final_results = [labelencoder.inverse_transform([i])[0] for i in results_list if i != 0]

            return Response(dumps({"success": True, "data": final_results},
                                  sort_keys=True, indent=4, default=json_util.default), status=200, mimetype='application/json')
        except Exception as e:
            app.logger.info('Server Error!')
            app.logger.exception(e)
            return Response(dumps({"success": False, "data": None},
                                  sort_keys=True, indent=4, default=json_util.default), status=500, mimetype='application/json')
    else:
        app.logger.info("Failed! Please provide valid parameters during the request.")
        return Response(dumps({"success": False, "data": None},
                              sort_keys=True, indent=4, default=json_util.default), status=404, mimetype='application/json')


@app.route('/donations/forecast/', methods=['POST'])
def forecast_upcoming_donations():
    today_data = request.form.get('today_data')
    yesterday_data = request.form.get('yesterday_data')
    past_2_days_data = request.form.get('past_2_days_data')
    past_3_days_data = request.form.get('past_3_days_data')

    if today_data is not None and yesterday_data is not None and past_2_days_data is not None and past_3_days_data is not None:
        try:
            past_data= []
            today_data = ast.literal_eval(today_data)
            yesterday_data = ast.literal_eval(yesterday_data)
            past_2_days_data = ast.literal_eval(past_2_days_data)
            past_3_days_data = ast.literal_eval(past_3_days_data)
            past_data.append(today_data)
            past_data.append(yesterday_data)
            past_data.append(past_2_days_data)
            past_data.append(past_3_days_data)
            array_input = []
            for index in past_data:
                ind_data = []
                for data in index:
                    ind_data.append(labelencoder.transform([data])[0])
                len_ind_data = len(ind_data)
                if len_ind_data < 39:
                    no_to_balance = 39 - len_ind_data
                    for _ in range(no_to_balance):
                        ind_data.append(0)
                elif len_ind_data > 39:
                    ind_data = ind_data[:39]
                array_input.append(ind_data)

            results = donations_forecast_model.predict(np.array(array_input).reshape(1, 4, 39))
            results_list = [int(round(i)) for i in list(results)[0]]
            final_results = [labelencoder.inverse_transform([i])[0] for i in results_list if i != 0]

            return Response(dumps({"success": True, "data": final_results},
                                  sort_keys=True, indent=4, default=json_util.default), status=200, mimetype='application/json')
        except Exception as e:
            app.logger.info('Server Error!')
            app.logger.exception(e)
            return Response(dumps({"success": False, "data": None},
                                  sort_keys=True, indent=4, default=json_util.default), status=500, mimetype='application/json')
    else:
        app.logger.info("Failed! Please provide valid parameters during the request.")
        return Response(dumps({"success": False, "data": None},
                              sort_keys=True, indent=4, default=json_util.default), status=404, mimetype='application/json')


if __name__ == '__main__':
    app.run(host="localhost")
