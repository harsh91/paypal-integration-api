| Domain | Method   | URI                        | Name           | Action                                                       | Middleware   |
| ------ | -------- | -------------------------- | -------------- | ------------------------------------------------------------ | ------------ |
|        | GET|HEAD | /                          |                | Closure                                                      | web          |
|        | GET|HEAD | api/user                   |                | Closure                                                      | api,auth:api |
|        | POST     | create-payment             | create-payment | App\Http\Controllers\PaymentController@create                | web          |
|        | GET|HEAD | execute-agreement/{status} |                | App\Http\Controllers\SubscriptionController@executeAgreement | web          |
|        | GET|HEAD | execute-payment            |                | App\Http\Controllers\PaymentController@execute               | web          |
|        | GET|HEAD | plan/create                |                | App\Http\Controllers\SubscriptionController@createSimplePlan | web          |
|        | GET|HEAD | plan/delete                |                | App\Http\Controllers\SubscriptionController@deletePlan       | web          |
|        | GET|HEAD | plan/list                  |                | App\Http\Controllers\SubscriptionController@listPlans        | web          |
|        | GET|HEAD | plan/{id}                  |                | App\Http\Controllers\SubscriptionController@getPlan          | web          |
|        | GET|HEAD | plan/{id}/activate         |                | App\Http\Controllers\SubscriptionController@activatePlan     | web          |
|        | POST     | plan/{id}/agreement/create |                | App\Http\Controllers\SubscriptionController@createAgreement  | web          |