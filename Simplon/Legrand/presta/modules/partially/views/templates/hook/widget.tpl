{*
* Copyright 2018 Partial.ly
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*    http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
*  @author Partial.ly <partiallyapp@gmail.com>
*  @copyright  2015-2018 Partial.ly
*  @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License, Version 2.0
*}
<div id="widgetContainer"></div>
<script type="text/javascript">
document.partiallyWidgetConfig = {$widget_config_json nofilter};
(function() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = '{$js_url|escape:'htmlall':'UTF-8'}';
  script.async = true;
  document.head.appendChild(script);
})();
</script>
